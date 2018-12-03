import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import Api from './api'

export default new Vuex.Store({
  state: {
    mode: 'Build',
    theme: false,
    status: [],
    site: {
      slug: undefined,
      content: {},
    },
    openhours: {}
  },
  getters: {
    mode: state => state.mode,
    content: state => state.site.content,
    status: state => state.status,
    slug: state => state.site.slug,
    openhours: state => state.openhours,
    theme: state => state.theme,
  },
  mutations: {
    setContent: (state, content) => state.site.content = content,
    setOpenhours: (state, openhours) => state.openhours = openhours,
  	setModeBuild: state => state.mode = 'Build',
    setModeRender: state => state.mode = 'Render',
    setSlug: (state, slug) => state.site.slug = slug,
    addStatus: (state, status) => {
      state.status.push(status)
    },
    removeStatus: (state, msgToRemove) => {
      state.status = state.status.filter(item => item.msg !== msgToRemove)
    },
    setTheme: (state, theme) => state.theme = theme
  },
  actions: {
    toggleMode ({state, commit}) {
    	if(state.mode == 'Build') return commit('setModeRender')
    	return commit('setModeBuild')
    },
    setOpenhours({commit}, openhours) {
      return commit('setOpenhours', openhours)
    },
    storeContent({state, commit}) {

      Api.storeContent({
        name: state.site.content.name,
        content: state.site.content,
        theme: state.theme,
        openhours: state.openhours,
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
        openhours: state.openhours,
        theme: state.theme
      })
      .then(res => {
        if(res.status == 200) {
          commit('addStatus', {type: 'success', msg: 'Gemt!'})
          setTimeout(() => {
            commit('removeStatus', 'Gemt!')
          }, 2000);
        }
      })
      .catch(error => {
        if(error.response.status === 419) window.location.href = "/login";
      })

    }
  }
})