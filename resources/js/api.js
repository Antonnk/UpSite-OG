import axios from 'axios'

export default {
  storeContent(content) {
    return axios.post('/sites', content)
  } 
}