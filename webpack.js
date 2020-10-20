const
webpack = require('webpack'),
path = require('path'),
conf = require('dotenv').config({path: './webpack.env'}),
webroot = conf.parsed.PUBLIC_PATH,
prefix = process.env

const
MiniCssExtractPlugin = require("mini-css-extract-plugin"),
TerserPlugin = require('terser-webpack-plugin'),
VueLoaderPlugin = require('vue-loader/lib/plugin'),
{ CleanWebpackPlugin } = require('clean-webpack-plugin')

const
optimization = (type) =>
{
  return {
    minimize: true,
    minimizer: [new TerserPlugin()]
  }
},
postcssOptions =
{
  app:
  {

  },
  vendor:
  {
    ident: 'postcss',
    plugins: [
      require('cssnano')({preset: ['default', {discardComments: {removeAll: true}}]})
    ]
  }
},
rules =
{
  babel:
  {
    test: /\.js$/,
    use: {
      loader: 'babel-loader',
      options: {
        presets: ['@babel/preset-env'],
        plugins: ["@babel/plugin-syntax-dynamic-import"]
      }
    }
  },
  postcss: (type) => {
    return {
      test: /\.(css)$/,
      exclude: /node_modules/,
      use: [
        { loader: MiniCssExtractPlugin.loader},
        { loader: 'css-loader' },
        {
          loader: 'postcss-loader',
          options:{ postcssOptions: postcssOptions[type] }
        }
      ]
    }
  }
}

const
prefixes = ['front','admin'],
vendors = () =>
{
  return prefixes.map(prefix => {
    return {
      mode: 'production',
      name: 'vendor-'+prefix,
      entry: path.join(__dirname, 'resources/assets/'+prefix, 'vendor.conf.js'),
      output: {
        path: path.resolve(__dirname, 'webroot'),
        filename: 'js/'+prefix+'/vendor.min.js',
      },
      optimization: optimization('vendor'),
      module: {
        rules: [
          rules.babel,
          rules.postcss('vendor')
        ]
      },
      plugins: [
        new CleanWebpackPlugin({
          cleanOnceBeforeBuildPatterns: [
            path.join(__dirname,'webroot','js/'+prefix+'/components/*')
          ],
        }),
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

apps = () =>
{
  return prefixes.map(prefix => {
    return {
      mode: 'production',
      name: 'app-'+prefix,
      entry: './resources/assets/'+prefix+'/app.conf.js',
      output: {
        path: path.resolve(__dirname, 'webroot'),
        publicPath: webroot,
        filename: 'js/'+prefix+'/app.min.js',
        chunkFilename: 'js/'+prefix+'/components/[hash].[name].min.js',
      },
      optimization: {
        minimize: true,
        minimizer: [new TerserPlugin({
          extractComments: false,
          parallel: true
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
                postcssOptions:
                {
                  ident: 'postcss',
                  plugins: loader => [
                    require('postcss-preset-env')(),
                    require('pixrem')(),
                    require('autoprefixer')({overrideBrowserslist: 'last 10 versions'}),
                    require('cssnano')()
                  ]
                }
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
    }
  })
}

//console.log(apps().concat(vendors()));

module.exports = apps().concat(vendors())
