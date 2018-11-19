import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import Api from './api'

export default new Vuex.Store({
  state: {
    mode: 'Build',
    slug: undefined,
    content: {},
    openhours: {}
  },
  getters: {
    mode: state => state.mode,
    content: state => state.content
  },
  mutations: {
    setContent: (state, content) => state.content = content,
  	setModeBuild: state => state.mode = 'Build',
    setModeRender: state => state.mode = 'Render',
    setSlug: (state, slug) => state.slug = slug
  },
  actions: {
    toggleMode ({state, commit}) {
    	if(state.mode == 'Build') return commit('setModeRender')
    	return commit('setModeBuild')
    },
    storeContent({state, commit}, content) {
      Api.storeContent({
        name: content.name,
        content: content,
        openhours: []
      }).then(res => {
        commit('setSlug', res.data.slug)
      }).catch(error => console.error(error))
    }
  }
})