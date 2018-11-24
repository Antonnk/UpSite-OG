import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import Api from './api'

export default new Vuex.Store({
  state: {
    mode: 'Build',
    theme: false,
    status: {
      type: 'default',
      msg: ''
    },
    site: {
      slug: undefined,
      content: {},
      openhours: {}
    }
  },
  getters: {
    mode: state => state.mode,
    content: state => state.site.content,
    status: state => state.status,
    slug: state => state.site.slug,
  },
  mutations: {
    setContent: (state, content) => state.site.content = content,
  	setModeBuild: state => state.mode = 'Build',
    setModeRender: state => state.mode = 'Render',
    setSlug: (state, slug) => state.site.slug = slug,
    setStatus: (state, type, msg) => state.stauts = { type, msg },
    setTheme: (state, theme) => state.theme = theme
  },
  actions: {
    toggleMode ({state, commit}) {
    	if(state.mode == 'Build') return commit('setModeRender')
    	return commit('setModeBuild')
    },
    storeContent({state, commit}) {

      Api.storeContent({
        name: state.site.content.name,
        content: state.site.content,
        openhours: state.site.openhours,
        theme: state.theme
      })
      .then(res => {
        if(res.data.redirect) window.location.href = res.data.redirect;
      })
      .catch(error => console.error(error))

    },
    updateContent({state, commit}) {

      Api.updateContent({
        name: state.site.content.name,
        content: state.site.content,
        openhours: state.site.openhours,
        theme: state.theme
      })
      .then(res => {
        console.log(res)
        //if(res.data.redirect) window.location.href = res.data.redirect;
      })
      .catch(error => console.error(error))

    }
  }
})