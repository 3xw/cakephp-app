require('dotenv').config()

const
path = require('path'),
webroot = process.env.PUBLIC_PATH

const
MiniCssExtractPlugin = require("mini-css-extract-plugin"),
rules =
{
  babel:
  {
    test: /\.js$/,
    exclude: path.resolve(__dirname, 'node_modules/'),
    use: {
      loader: 'babel-loader',
      options: {
        plugins: [
          ["@babel/plugin-proposal-private-methods", { "loose": true }],
          ["@babel/plugin-proposal-class-properties", { "loose": true }],
          ["@babel/plugin-proposal-private-property-in-object", { "loose": true }],
          "@babel/plugin-syntax-dynamic-import",
        ]
      }
    }
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
      {
        loader: 'css-loader',
        options: {
          url: false
        }
      },
      {
        loader: 'postcss-loader',
        options:
        {
          postcssOptions: {
            ident: 'postcss',
            plugins: [
              'postcss-preset-env',
              'autoprefixer',
              'cssnano'
            ]
          }
        }
      },
      {
        loader: 'sass-loader',
        options: {
          sourceMap: true,
        }
      }
    ]
  }
}

module.exports = rules
