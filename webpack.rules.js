const
path = require('path'),
conf = require('dotenv').config({path: './webpack.env'}),
webroot = conf.parsed.PUBLIC_PATH

const
MiniCssExtractPlugin = require("mini-css-extract-plugin"),
rules =
{
  babel:
  {
    test: /\.js$/,
    use: {
      loader: 'babel-loader'
    },
    exclude: path.resolve(__dirname, 'node_modules/')
  },
  vue:
  {
    test: /\.vue$/,
    loader: 'vue-loader',
    options: {
      cacheBusting: true,
    }
  },
  scss:
  {
    test: /\.(scss)$/,
    exclude: /node_modules/,
    use: [
      { loader: MiniCssExtractPlugin.loader},
      { loader: 'css-loader' },
      {
        loader: 'postcss-loader',
        options:
        {
          postcssOptions: {
            ident: 'postcss',
            plugins: [
              'postcss-preset-env',
              'pixrem',
              [
                'autoprefixer',
                {overrideBrowserslist: 'last 10 versions'}
              ],
              'cssnano'
            ]
          }
        }
      },
      { loader: 'resolve-url-loader' },
      { loader: 'sass-loader' },
    ]
  },
  css:
  {
    test: /\.css$/,
    use: [
      'vue-style-loader',
      'css-loader',
    ]
  },
  fonts:
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
  },
  imgs:
  {
    test: /\.(jpg|png|gif)(\?v=\d+\.\d+\.\d+)?$/,
    use: [{
      loader: 'file-loader',
      options: {
        name: '[name].[ext]',
        publicPath: webroot+'img/webpack',
        outputPath: 'img/webpack'
      }
    }]
  },
}

module.exports = rules
