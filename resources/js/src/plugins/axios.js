import Cookies from 'js-cookie'
const config = {
    baseURL:  process.env.VITE_API_HOST || 'http://localhost:8000',
    timeout: 60 * 1000 // Timeout
}
  console.log( process.env.VITE_API_HOST, ' process.env.VITE_API_HOST');
const _axios = axios.create(config)

_axios.interceptors.request.use(
    function (config) {
        const accessToken = Cookies.get('access_token')
        if(accessToken){
            config.headers['Authorization'] = `Bearer ${ accessToken }`;
        }
        return config
    },
    function (error) {
        return Promise.reject(error)
    }
)

_axios.interceptors.response.use(
    function (response) {
        response = typeof response.data !== undefined ? response.data : response
        return response
    },

    function (error) {
        return Promise.reject(error)
    }
)

const api = _axios
export default api