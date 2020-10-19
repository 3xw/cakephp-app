const
webpack = require('webpack'),
path = require('path'),
conf = require('dotenv').config({path: './webpack.env'}),
webroot = conf.parsed.PUBLIC_PATH,
prefix = process.env

const
MiniCssExtractPlugin = require("mini-css-extract-plugin"),
UglifyJsPlugin = require('uglifyjs-webpack-plugin'),
VueLoaderPlugin = require('vue-loader/lib/plugin')

const
prefixes = ['front','admin'],
vendor = () =>
{
  return prefixes.map(prefix => {
    return {
      mode: 'production',
      name: 'vendor',
      entry: path.join(__dirname, 'resources/assets/'+prefix, 'vendor.conf.js'),
      output: {
        path: path.resolve(__dirname, 'webroot'),
        filename: 'js/'+prefix+'/vendor.min.js',
      },
      optimization: {
        minimizer: [new UglifyJsPlugin({
          extractComments: false,
          parallel: true,
          uglifyOptions: {
            keep_fnames: true,
            mangle: true,
          }
        })],
      },
      module: {
        rules: [
          {
            test: /\.js$/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env'],
                plugins: [
                  "@babel/plugin-syntax-dynamic-import"
                ]
              }
            }
          },
          {
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
          }
        ]
      },
      plugins: [
        new MiniCssExtractPlugin({
          filename: 'css/'+prefix+'/vendor.min.css',
        }),
        new webpack.IgnorePlugin({
          resourceRegExp: /^\.\/locale$/,
          contextRegExp: /moment$/
        }),
        new webpack.IgnorePlugin({
          resourceRegExp: /got$/,
          contextRegExp: /vuejs$/
        }),
      ],
      resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['*', '.js', '.vue', '.json']
      },
    }
  })
},

app = () =>
{
  return prefixes.map(prefix => {
    mode: 'production',
    name: 'themeAppConfig',
    entry: './resources/assets/'+prefix+'/themeApp.conf.js',
    output: {
      path: path.resolve(__dirname, 'webroot'),
      publicPath: webroot,
      filename: 'js/'+prefix+'/app.min.js',
      chunkFilename: 'js/'+prefix+'/components/[hash].[name].min.js',
    },
    optimization: {
      minimizer: [new UglifyJsPlugin()],
    },
    module: {
      rules: [
        {
        test: /\.js$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: [
              "@babel/plugin-syntax-dynamic-import"
            ]
          }
        }
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          cacheBusting: true,
        }
      },
      {
        test: /\.(scss)$/,
        use: [
          { loader: MiniCssExtractPlugin.loader, },
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: loader => [
                require('postcss-preset-env')(),
                require('pixrem')(),
                require('autoprefixer')({overrideBrowserslist: 'last 10 versions'}),
                require('cssnano')()
              ]
            }
          },
          { loader: 'resolve-url-loader' },
          { loader: 'sass-loader' },
        ]
      },
      {
        test: /\.css$/,
        use: [
          'vue-style-loader',
          'css-loader',
          'sass-loader'
        ]
      },
      {
          test: /\.(woff(2)?|ttf|otf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
          use: [{
              loader: 'file-loader',
              options: {
                  name: '[name].[ext]',
                  publicPath: webroot+'fonts/',
                  outputPath: 'fonts/'
              }
          }]
      }]
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/'+prefix+'/theme.min.css',
        chunkFilename: 'css/'+prefix+'/components/[name].min.css',
      }),
      new VueLoaderPlugin()
    ],
    resolve: {
      alias: {
          'vue$': 'vue/dist/vue.esm.js'
      },
      extensions: ['*', '.js', '.vue', '.json']
    },
  })
}

module.exports = [vendor, app];
