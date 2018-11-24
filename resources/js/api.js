import axios from 'axios'

export default {
  storeContent(content) {
    return axios.post('/sites', content)
  },
  updateContent(content) {
    return axios.put(`/sites/${window.slug}`, content)
  }, 
}