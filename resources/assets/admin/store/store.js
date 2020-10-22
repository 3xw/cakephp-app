import Vuex from 'vuex'
import {createEasyAccess, defaultMutations} from 'vuex-easy-access'

Vue.use(Vuex)

// do the magic 🧙🏻‍♂️
const
easyAccess = createEasyAccess(),
state = {}

export default new Vuex.Store({
  state: state, // pass state to state,
  plugins: [easyAccess],
  mutations:{},
  actions:{},
  mutations:
  {
    // do the magic 🧙🏻‍♂️
    ...defaultMutations(state)
  },
  modules: {}
})
