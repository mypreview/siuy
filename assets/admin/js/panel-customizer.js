/**
 * Siuy Customizer Scripts
 *
 * @author      Mahdi Yazdani
 * @package     Siuy
 * @since       1.1.4
 */
/**
 * "Plus" theme section
 * Using the Customize API for adding a "plus" link to the customizer.
 *
 * @see         https://github.com/justintadlock/trt-customizer-pro/blob/master/example-1/class-customize.php
 * @author      Mahdi Yazdani
 * @package     Siuy
 * @since       1.1.4
 */
(function(api) {
    // Extends our custom section.
    api.sectionConstructor['siuy_go_plus_control'] = api.Section.extend({
        // No events for this type of section.
        attachEvents: function() {},
        // Always make the section active.
        isContextuallyActive: function() {
            return true;
        }
    });
})(wp.customize);
