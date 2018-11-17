import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    mode: 'Render'
  },
  getters: {
    mode: state => state.mode
  },
  mutations: {
  	setModeBuild: state => state.mode = 'Build',
    setModeRender: state => state.mode = 'Render'
  },
  actions: {
    toggleMode ({state, commit}) {
    	if(state.mode == 'Build') return commit('setModeRender')
    	return commit('setModeBuild')
    }
  }
})