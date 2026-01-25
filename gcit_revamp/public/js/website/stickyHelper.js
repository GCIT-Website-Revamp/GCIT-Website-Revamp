/**
 * Unified Sticky Helper using GSAP ScrollTrigger
 * Provides consistent sticky sidebar behavior across the site
 */

/**
 * Creates a GSAP ScrollTrigger pin for sticky sidebar behavior
 * @param {Object} options Configuration options
 * @param {string|Element} options.element - Selector or element for the sticky element
 * @param {string|Element} options.container - Selector or element for the scrolling container
 * @param {number} [options.topOffset=0] - Top offset in pixels when sticky
 * @param {number} [options.minWidth=1024] - Minimum viewport width to enable sticky
 * @param {boolean} [options.pinSpacing=false] - Whether to add spacing for the pinned element
 * @param {Function} [options.onRefresh] - Callback when ScrollTrigger refreshes
 * @returns {Object} Object containing ScrollTrigger instance and cleanup function
 */
function createStickyPin(options) {
    const {
        element,
        container,
        topOffset = 0,
        minWidth = 1024,
        pinSpacing = false,
        onRefresh = null
    } = options;

    // Ensure GSAP and ScrollTrigger are available
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Sticky behavior disabled.');
        return { instance: null, cleanup: () => {} };
    }

    gsap.registerPlugin(ScrollTrigger);

    let pinInstance = null;
    let resizeHandler = null;

    /**
     * Lock the element's width to prevent layout shifts when pinned
     */
    function lockWidth(el) {
        if (!el) return;
        const rect = el.getBoundingClientRect();
        el.style.width = rect.width + 'px';
        el.style.height = 'fit-content';
    }

    /**
     * Reset element styles
     */
    function resetStyles(el) {
        if (!el) return;
        el.style.width = '';
        el.style.height = '';
        el.style.position = '';
        el.style.top = '';
        el.style.left = '';
    }

    /**
     * Initialize the sticky pin
     */
    function init() {
        const el = typeof element === 'string' ? document.querySelector(element) : element;
        const cont = typeof container === 'string' ? document.querySelector(container) : container;

        if (!el || !cont) {
            console.warn('Sticky element or container not found:', { element, container });
            return;
        }

        // Lock width before creating pin
        lockWidth(el);

        // Create the ScrollTrigger pin
        pinInstance = ScrollTrigger.create({
            trigger: cont,
            start: `${topOffset}px top`,
            end: () => `bottom-=${el.offsetHeight + topOffset} top`,
            pin: el,
            pinSpacing: pinSpacing,
            pinType: 'transform',
            invalidateOnRefresh: true,
            onRefresh: () => {
                lockWidth(el);
                if (onRefresh) onRefresh(el);
            }
        });

        // Handle resize
        resizeHandler = () => {
            lockWidth(el);
            ScrollTrigger.refresh();
        };
        window.addEventListener('resize', resizeHandler);
    }

    /**
     * Cleanup function to destroy the pin and remove listeners
     */
    function cleanup() {
        if (pinInstance) {
            pinInstance.kill();
            pinInstance = null;
        }
        if (resizeHandler) {
            window.removeEventListener('resize', resizeHandler);
            resizeHandler = null;
        }

        const el = typeof element === 'string' ? document.querySelector(element) : element;
        if (el) {
            gsap.set(el, { clearProps: 'all' });
        }
    }

    // Use matchMedia for responsive behavior
    ScrollTrigger.matchMedia({
        [`(min-width: ${minWidth}px)`]: () => {
            init();
            return cleanup; // Return cleanup function for when media query no longer matches
        },
        [`(max-width: ${minWidth - 1}px)`]: () => {
            const el = typeof element === 'string' ? document.querySelector(element) : element;
            if (el) {
                resetStyles(el);
            }
        }
    });

    return {
        instance: pinInstance,
        cleanup: cleanup,
        refresh: () => ScrollTrigger.refresh()
    };
}

/**
 * Creates multiple sticky pins with the same container
 * @param {Object} options Base options
 * @param {Array<string|Element>} options.elements - Array of selectors or elements
 * @param {string|Element} options.container - Shared container
 * @param {number} [options.topOffset=0] - Top offset
 * @param {number} [options.minWidth=1024] - Minimum viewport width
 * @returns {Array} Array of pin objects
 */
function createMultipleStickyPins(options) {
    const { elements, container, topOffset = 0, minWidth = 1024 } = options;
    
    return elements.map(element => createStickyPin({
        element,
        container,
        topOffset,
        minWidth
    }));
}

// Export for module usage if available
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { createStickyPin, createMultipleStickyPins };
}
