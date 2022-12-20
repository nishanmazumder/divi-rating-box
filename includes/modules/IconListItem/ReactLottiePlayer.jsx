// External dependencies
import React from 'react'
import * as lottie from '../../../public/js/lib/lottie.js';
import JSZip from '../../../public/js/lib/jszip.min.js';

/**
 * Parse a resource into a JSON object or a URL string
 *
 * @param {string} src
 * @return string
 */
export function parse_src(src) {
    if (typeof src === "object") {
        return src;
    }

    try {
        return JSON.parse(src);
    } catch (e) {
        // Try construct an absolute URL from the src URL
        const srcUrl = new URL(src, window.location.href);

        return srcUrl.toString();
    }
}

/**
 * Collect data from url
 *
 * @param {string} url
 * @return Promise<string>
 */
export async function from_url(url) {
    if (typeof url !== "string") {
        throw new Error(`The url value must be a string`);
    }

    let json;

    try {
        // Try construct an absolute URL from the src URL
        const srcUrl = new URL(url);

        // Fetch the JSON file from the URL
        const result = await fetch(srcUrl.toString());

        json = await result.json();
    } catch (err) {
        throw new Error(
            `An error occurred while trying to load the Lottie file from URL`
        );
    }

    return json;
}

/**
 * Check lottie animation data object
 * @param {object} json
 * @return bool
 */
export function is_lottie(json) {
    const mandatory = ["v", "ip", "op", "layers", "fr", "w", "h"];

    return mandatory.every((field) =>
        Object.prototype.hasOwnProperty.call(json, field)
    );
}

/**
 * Load a resource from a path URL.
 *
 * @param {string} path
 * @return Promise<string>
 */
export function fetch_path(path) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', path, true);
        xhr.responseType = 'arraybuffer';
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                JSZip.loadAsync(xhr.response)
                    .then((zip) => {
                        zip
                            .file('manifest.json')
                            .async('string')
                            .then((manifestFile) => {
                                const manifest = JSON.parse(manifestFile);

                                if (!('animations' in manifest)) {
                                    throw new Error('Manifest not found');
                                }

                                if (manifest.animations.length === 0) {
                                    throw new Error('No animations listed in the manifest');
                                }

                                const defaultLottie = manifest.animations[0];

                                zip
                                    .file(`animations/${defaultLottie.id}.json`)
                                    .async('string')
                                    .then((lottieFile) => {
                                        const lottieJson = JSON.parse(lottieFile);

                                        if ('assets' in lottieJson) {
                                            Promise.all(
                                                lottieJson.assets.map(function (asset) {
                                                    if (!asset.p) {
                                                        return null;
                                                    }
                                                    if (zip.file(`images/${asset.p}`) == null) {
                                                        return null;
                                                    }

                                                    return new Promise(function (resolveAsset) {
                                                        const assetFileExtension = asset.p.split('.').pop();

                                                        zip
                                                            .file(`images/${asset.p}`)
                                                            .async('base64')
                                                            .then((assetB64) => {
                                                                if (assetFileExtension === 'svg' || assetFileExtension === 'svg+xml') {
                                                                    asset.p = 'data:image/svg+xml;base64,' + assetB64;
                                                                } else {
                                                                    asset.p = 'data:;base64,' + assetB64;
                                                                }

                                                                asset.e = 1;
                                                                resolveAsset();
                                                            });
                                                    });
                                                }),
                                            ).then(() => {
                                                resolve(lottieJson);
                                            });
                                        }
                                    });
                            });
                    })
                    .catch((err) => {
                        reject(err);
                    });
            }
        };
    });
}

// Define valid player states
export const PlayerState = {
    Loading: 'loading',
    Playing: 'playing',
    Paused: 'paused',
    Stopped: 'stopped',
    Frozen: 'frozen',
    Error: 'error',
};

// Define play modes
export const PlayMode = {
    Bounce: "bounce",
    Normal: "normal",
};

export default class extends React.Component {
    container = null;
    _counter = 1;
    intermission = 1;
    __isMounted = true;

    constructor(props) {
        super(props);

        this.defaultOptions = {
            autoplay: true,
            loop: true,
            hover: false,
            renderer: 'svg',
            speed: 1,
            direction: 1,
            playCount: 0,
            delay: 0,
            style: {},
            mode: 'normal',
            interaction: 'freeze-click',
            rendererSettings: {
                clearCanvas: false,
                hideOnTransparent: true,
                progressiveLoad: true,
            }
        }

        this.state = {
            animationData: null,
            background: 'transparent',
            containerRef: React.createRef(),
            debug: true,
            instance: null,
            playerState: PlayerState.Loading,
            seeker: 0,
        };
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        if (nextProps.background !== prevState.background) {
            return {background: nextProps.background};
        } else {
            return null;
        }
    }

    async componentDidMount() {
        if (this.__isMounted) {
            await this.createLottie();
        }
    }

    componentWillUnmount() {
        this.__isMounted = false;

        if (this.state.instance) {
            this.state.instance.destroy();
        }
    }

    async componentDidUpdate(prevProps) {
        if (this.props.src !== prevProps.src) {
            if (this.state.instance) {
                this.state.instance.destroy();
            }

            await this.createLottie();
        }
    }

    render() {
        const {children, loop, style, className} = this.props;
        const {animationData, instance, playerState, seeker, debug, background} = this.state;

        return (
            <div className="lottie-player-container">
                {playerState === PlayerState.Error ? (<div className="lf-error">
                    <span aria-label="error-symbol" role="img"> ⚠️</span>
                </div>) : (<div
                    id={this.props.id ? this.props.id : 'lottie'}
                    ref={el => (this.container = el)}
                    style={{
                        background,
                        margin: '0 auto',
                        outline: 'none',
                        overflow: 'hidden',
                        ...style,
                    }}
                    className={className}
                ></div>)}
                {React.Children.map(children, child => {
                    if (React.isValidElement(child)) {
                        return React.cloneElement(child, {
                            animationData,
                            background,
                            debug,
                            instance,
                            loop,
                            playerState,
                            seeker
                        });
                    }
                    return null;
                })}
            </div>
        );
    }

    async createLottie() {
        const {instance} = this.state;

        if (!this.__isMounted | undefined === this.props.src || undefined === this.container) {
            return;
        }

        // Load the resource information
        try {
            const lottieOptions = Object.assign(this.defaultOptions, this.props.lottieOptions);
            const lottieLoopOption = lottieOptions.loop && !!lottieOptions.playCount ? Number.parseInt(lottieOptions.playCount) : lottieOptions.loop;
            const srcParsed = this.props.src.endsWith('.lottie') ? await fetch_path(this.props.src) : parse_src(this.props.src);

            // the path to the animation json
            let srcAttrib = typeof srcParsed === "string" ? "path" : "animationData";

            // Clear previous animation, if any
            if (instance) {
                instance.destroy();
            }


            let jsonData = {};

            // enable delay mode
            setTimeout(async () => {
                // Initialize lottie player and load animation
                const newInstance = lottie.loadAnimation({
                    'rendererSettings': lottieOptions.rendererSettings,
                    [srcAttrib]: srcParsed,
                    'autoplay': lottieOptions.autoplay,
                    'container': this.container,
                    'loop': lottieLoopOption,
                    'renderer': lottieOptions.renderer,
                })

                if (srcAttrib === "path") {
                    jsonData = await from_url(srcParsed);
                } else {
                    jsonData = srcParsed;
                }

                // Show error when current file is not lottie image
                if (!is_lottie(jsonData)) {
                    this.setState(prevState => ({...prevState, playerState: PlayerState.Error}), () => {});
                }

                // Play with Lottie Image
                if (lottieOptions.background) {
                    this.setState(prevState => ({...prevState, background: this.props.background}), () => {});
                }

                // let containerElement: * | null;
                let containerElement;
                if (undefined !== this.props.reference && undefined !== this.props.reference.current) {
                    containerElement = this.props.reference.current;
                } else {
                    containerElement = this.container;
                }

                // Catch parent element
                containerElement = !!containerElement && !!containerElement.parentElement ? containerElement.parentElement : containerElement;

                // Attach all event listener and functionalities
                this._attachEventListeners(newInstance, lottieOptions, containerElement);

                // send lottie instance to uesr
                if (typeof this.props.lottieRef === 'function') {
                    this.props.lottieRef(newInstance);
                }

                if (lottieOptions.autoplay) {
                    newInstance.play();
                    this.setState(prevState => ({...prevState, playerState: PlayerState.Playing}), () => {});
                }
                this.setState(prevState => ({...prevState, instance: newInstance}), () => {});

            }, lottieOptions.delay);

        } catch (e) {
            this.setState(prevState => ({...prevState, playerState: PlayerState.Error}), () => {});
        }
    }

    _attachEventListeners(_lottie, lottieOptions, element) {
        // Set speed for lottie image
        if (!!lottieOptions.speed) {
            _lottie.setSpeed(Number.parseFloat(lottieOptions.speed));
        }

        // Set direction for lottie image
        if (!!lottieOptions.direction && lottieOptions.direction === -1) {
            _lottie.setDirection(-1);
        }

        // Hover event when interactivity mode turn off
        if (lottieOptions.hover) {
            this.lottie_play_on_hover(_lottie, element)

            // Fired at an Element when a pointing device (usually a mouse) is used to move the cursor so that it is no longer contained within the element
            if (!!element) {
                element.addEventListener('mouseout', () => {
                    _lottie.pause();
                });
            }
        }

        // Set direction when the animation completed for lottie image when the animation mode is bounce
        if (lottieOptions.mode === 'bounce' && ['svg', 'canvas'].includes(lottieOptions.renderer)) {
            this.lottie_bounce_effect(_lottie, lottieOptions)
        }

        // Freeze animation on click
        if (lottieOptions.autoplay && lottieOptions.interaction === 'freeze-click') {
            this.lottie_pause_on_click(_lottie, element)
        }

        // Freeze animation on click
        if (!lottieOptions.autoplay && lottieOptions.interaction === 'click') {
            this.lottie_play_on_click(_lottie, element)
        }

        // Freeze animation on click
        if (!lottieOptions.autoplay && lottieOptions.interaction === 'hover') {
            this.lottie_play_on_hover(_lottie, element)

            if (!!lottieOptions.click_event && lottieOptions.click_event === 'lock') {
                this.lottie_pause_on_click(_lottie, element)
            }

            if (!!lottieOptions.click_event && lottieOptions.click_event === 'reverse') {
                this.lottie_play_reverse_on_click(_lottie, lottieOptions, element)
            }

            // Fired at an Element when a pointing device (usually a mouse) is used to move the cursor so that it is no longer contained within the element
            if (!!element) {
                element.addEventListener('mouseout', () => {
                    if (lottieOptions.interaction === 'hover'
                        && !!lottieOptions.mouse_out_event
                        && lottieOptions.mouse_out_event === 'reverse') {
                        this.lottie_bounce_effect(_lottie, lottieOptions)
                    } else {
                        _lottie.pause();
                    }
                });
            }
        }
    }

    lottie_bounce_effect(_lottie, lottieOptions) {
        let currentCount = 0;
        if (lottieOptions.loop) {
            // Play reverse on loop complete
            _lottie.addEventListener('loopComplete', () => {
                _lottie.stop();
                _lottie.setDirection(_lottie.playDirection * -1);
                _lottie.play();
            });
        } else {
            // Play reverse on complete
            _lottie.addEventListener('complete', () => {
                currentCount++;
                if (currentCount < 2) {
                    _lottie.setDirection(_lottie.playDirection * -1);
                    _lottie.play();
                }
            });
        }
    }

    lottie_play_reverse_on_click(_lottie, lottieOptions, element) {
        // Fired at an Element when a pointing device (such as a mouse or trackpad) is used to lick the element.
        if (!!element) {
            element.addEventListener('click', () => {
                if (lottieOptions.loop) {
                    // Play reverse on loop complete
                    _lottie.stop();
                    _lottie.setDirection(_lottie.playDirection * -1);
                    _lottie.play();
                } else {
                    // Play reverse on complete
                    _lottie.stop();
                    _lottie.setDirection(_lottie.playDirection * -1);
                    _lottie.play();
                }
            });
        }
    }

    lottie_play_on_hover(_lottie, element) {
        // Fired at an Element when a pointing device (such as a mouse or trackpad) is used to move the cursor onto the element.
        if (!!element) {
            element.addEventListener('mouseover', () => {
                _lottie.play();
            });
        }
    }

    lottie_pause_on_click(_lottie, element) {
        // Fired at an Element when a pointing device (such as a mouse or trackpad) is used to lick the element.
        if (!!element) {
            element.addEventListener('click', () => {
                _lottie.pause();
            });
        }
    }

    lottie_play_on_click(_lottie, element) {
        // Fired at an Element when a pointing device (such as a mouse or trackpad) is used to lick the element.
        if (!!element) {
            element.addEventListener('click', () => {
                _lottie.play();
            });
        }
    }

}