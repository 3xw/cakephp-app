const webpack = require('webpack');
const path = require('path');
const prefix = process.env;

const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin')

const vendorConfig = env => {
  return {
    mode: 'production',
    name: 'vendorConfig',
    entry: './src/Assets/'+env.prefix+'/vendor.conf.js',
    output: {
      path: path.resolve(__dirname, 'webroot'),
      filename: 'js/'+env.prefix+'/vendor.min.js'
    },
    optimization: {
      minimizer: [new UglifyJsPlugin({
        parallel: true,
      })],
    },
    module: {
      rules: [{
        test: /\.(css)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: loader => [
                require('cssnano')({
                  preset: ['default', {
                    discardComments: {
                      removeAll: true,
                    }
                  }]
                })
              ]
            }
          }
        ]
      }]
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/'+env.prefix+'/vendor.min.css',
      }),
      new webpack.IgnorePlugin({
        resourceRegExp: /^\.\/locale$/,
        contextRegExp: /moment$/
      }),
      new webpack.IgnorePlugin({
        resourceRegExp: /got$/,
        contextRegExp: /vuejs$/
      })
    ]
  }
};

const themeAppConfig = env => {
  return {
    mode: 'production',
    name: 'themeAppConfig',
    entry: './src/Assets/'+env.prefix+'/themeApp.conf.js',
    output: {
      path: path.resolve(__dirname, 'webroot'),
      filename: 'js/'+env.prefix+'/app.min.js'
    },
    watch: true,
    optimization: {
      minimizer: [new UglifyJsPlugin()],
    },
    module: {
      rules: [{
        test: /\.(scss)$/,
        use: [
          { loader: MiniCssExtractPlugin.loader, },
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: loader => [
                require('pixrem')(),
                require('autoprefixer')({browsers: 'last 10 versions'}),
                require('cssnano')()
              ]
            }
          },
          { loader: 'sass-loader' }

        ]
      }]
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/'+env.prefix+'/theme.min.css',
      })
    ]
  }
}

const vueConfig = env => {
  return {
    mode: 'production',
    name: 'vueConfig',
    watch: true,
    entry: './src/Assets/'+env.prefix+'/vue.conf.js',
    output: {
      path: path.resolve(__dirname, 'webroot'),
      chunkFilename: 'js/'+env.prefix+'/components/[name].min.js',
      filename: 'js/'+env.prefix+'/components/[name].min.js'
    },
    module: {
      rules: [
        {
       test: /\.vue$/,
       loader: 'vue-loader'
       },
       {
         test: /\.js$/,
         loader: 'babel-loader'
       },
       {
         test: /\.css$/,
         use: [
           'vue-style-loader',
           'css-loader',
           'sass-loader'
         ]
       }
      ]
    },
    plugins: [
      new VueLoaderPlugin()
    ]
  }
}



module.exports = [vendorConfig, themeAppConfig, vueConfig];
