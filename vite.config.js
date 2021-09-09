import { defineConfig } from 'vite'

const
{ resolve } = require('path'),
{ createVuePlugin } = require('vite-plugin-vue2'),
conf = require('dotenv').config({path: './vite.env'}),
webroot = conf.parsed.PUBLIC_PATH,
prefix = process.env

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    lib: {
      entry: resolve(__dirname, 'resources/assets/front/main.js'),
      name: 'main',
      fileName: (format) => `main.${format}.js`
    },
    rollupOptions: {
      external: ['vue', 'vue-packery-plugin', 'vuex', 'vue-images-loaded', 'bootstrap', 'element-ui', 'moment', 'sortable', 'vuex-crud', 'axios', 'bootstrap', 'vuex-easy-access'],
      output: {
        globals: {
          vue: 'Vue',
        }
      }
    }
  },
  plugins: [createVuePlugin({

  })],
  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources/assets', 'front'),
      '©': resolve(__dirname, 'vendor'),
      'vue$': 'vue/dist/vue.esm.js'
    },
  },
})
