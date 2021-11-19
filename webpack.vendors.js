require('dotenv').config()

const
webpack = require('webpack'),
path = require('path'),
conf = require('dotenv').config({path: './webpack.env'}),
webroot = process.env.PUBLIC_PATH

// WebpackPlugins
const
MiniCssExtractPlugin = require("mini-css-extract-plugin"),
TerserPlugin = require('terser-webpack-plugin'),
{ CleanWebpackPlugin } = require('clean-webpack-plugin')

// settings
const
rules = require('./webpack.rules.js'),
optimization =
{
  minimize: true,
  minimizer: [new TerserPlugin({
    terserOptions: {
      keep_classnames: true,
      keep_fnames: true
    },
  })]
},
plugins = (prefix) => {
  return [
    new webpack.DefinePlugin({
      BASE_URL: JSON.stringify(process.env.BASE_URL)
    }),
    new MiniCssExtractPlugin({
      filename: 'css/'+prefix+'/[name].min.css',
    })
  ]
},
entry = (prefix) =>
{
  // play here with prefix and output...
  let entry =
  {
    vendors: [
      './resources/assets/'+prefix+'/vendors.js',
      './resources/assets/'+prefix+'/assets/scss/vendors.scss'
    ],
  }

  return entry
}
// configs
const
prefixes = ['front','admin'],
configs = prefixes.map(prefix => {
  return {
    cache: false,
    mode: 'production',
    name: 'vendors-'+prefix,
    entry: entry(prefix),
    output: {
      path: path.resolve(__dirname, 'webroot'),
      publicPath: webroot,
      filename: 'js/'+prefix+'/[name].min.js',
      chunkFilename: 'js/'+prefix+'/components/[fullhash].[name].min.js',
      libraryTarget: 'umd'
    },
    optimization,
    module: {
      rules: [
        rules.babel,
        rules.scss
      ]
    },
    plugins: plugins(prefix),
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/assets', prefix),
        '©': path.resolve(__dirname, 'vendor'),
        'vue$': 'vue/dist/vue.esm.js'
      },
      extensions: ['*', '.js', '.vue', '.json']
    },
  }
})

//console.log(configs)
module.exports = configs
