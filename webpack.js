const
webpack = require('webpack'),
path = require('path'),
conf = require('dotenv').config({path: './webpack.env'}),
webroot = conf.parsed.PUBLIC_PATH,
prefix = process.env

// WebpackPlugins
const
MiniCssExtractPlugin = require("mini-css-extract-plugin"),
TerserPlugin = require('terser-webpack-plugin'),
VueLoaderPlugin = require('vue-loader/lib/plugin'),
{ CleanWebpackPlugin } = require('clean-webpack-plugin')

// settings
const
rules = require('./webpack.rules.js'),
optimization =
{
  minimize: true,
  minimizer: [new TerserPlugin()]
},
plugins = (prefix) => {
  return [
    new webpack.DefinePlugin({
      BASE_URL: JSON.stringify(conf.parsed.BASE_URL)
    }),
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: [
        path.join(__dirname,'webroot','js/'+prefix+'/components/*'),
        path.join(__dirname,'webroot','css/'+prefix+'/components/*')
      ],
    }),
    new MiniCssExtractPlugin({
      filename: 'css/'+prefix+'/[name].min.css',
      chunkFilename: 'css/'+prefix+'/components/[name].min.css',
    }),
    new VueLoaderPlugin()
  ]
},
entry = (prefix) =>
{
  // play here with prefix and output...
  let entry =
  {
    main: [
      './resources/assets/'+prefix+'/main.js',
      './resources/assets/'+prefix+'/assets/scss/theme.scss'
    ],
    common: './resources/assets/'+prefix+'/common.js'
  }

  return entry
}

// configs
const
prefixes = ['front','admin'],
configs = prefixes.map(prefix => {
  return {
    mode: 'production',
    name: 'app-'+prefix,
    entry: entry(prefix),
    output: {
      path: path.resolve(__dirname, 'webroot'),
      publicPath: webroot,
      filename: 'js/'+prefix+'/[name].min.js',
      chunkFilename: 'js/'+prefix+'/components/[fullhash].[name].min.js',
    },
    optimization,
    module: {
      rules: [rules.babel, rules.vue, rules.scss, rules.css, rules.fonts]
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
