/**
 * This Webpack config file allows to configure and extend
 * basic functionality offered by WordPress scripts.
 *
 * @requires Webpack
 * @author   MyPreview (Github: @mahdiyazdani, @gooklani, @mypreview)
 */
const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config.js' );
const { resolve } = require( 'path' );
const WebpackRTLPlugin = require( 'webpack-rtl-plugin' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );
const LicenseCheckerWebpackPlugin = require( 'license-checker-webpack-plugin' );

module.exports = {
	...defaultConfig,
	entry: {
		editor: resolve( process.cwd(), 'src', 'editor/index.js' ),
		frontend: resolve( process.cwd(), 'src', 'frontend/index.js' ),
	},
	plugins: [
		...defaultConfig.plugins,
		new WebpackRTLPlugin( {
			filename: '[name]-rtl.css',
		} ),
		new LicenseCheckerWebpackPlugin( {
			outputFilename: './credits.txt',
		} ),
		new WebpackNotifierPlugin( {
			title: 'Siuy',
			emoji: true,
			alwaysNotify: true,
			skipFirstNotification: true,
		} ),
	],
};
