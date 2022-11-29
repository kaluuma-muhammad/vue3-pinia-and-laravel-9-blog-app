import axios from "axios"
import Nprogress from 'nprogress'

window.axios = axios
axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.headers.common.crossDomain = true;

axios.interceptors.request.use(function(config) {
    config.headers.common = {
        Authorization: `Bearer ${localStorage.getItem('pinia_api_auth_key')}`,
        "Content-Type": "application/json",
        Accept: "application/json"
    }

    config.headers.post = {
        Authorization: `Bearer ${localStorage.getItem('pinia_api_auth_key')}`,
        "Content-Type": "application/x-www-form-urlencoded",
        Accept: "application/json"
    }

    return config;
}, (error) => {
    return Promise.reject(error);
})

axios.interceptors.request.use(config =>{
    Nprogress.start()
    return config;
})

axios.interceptors.request.use(response =>{
    Nprogress.done()
    return response;
})