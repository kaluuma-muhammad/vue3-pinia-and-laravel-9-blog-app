import { defineStore } from 'pinia'
import axios from 'axios'
import router from '@/router'
import { useToast } from 'vue-toastification'
const toast = useToast()

export const useAuthStore = defineStore('auth', {
	state: () => ({
		authUser: null,
        authLocation: null,
        isAuth: null,
	}),

	getters: {
		auth_user: (state )=> state.authUser,
		auth_location: (state )=> state.authLocation,
		is_auth: state => !!state.authUser,
	},

	actions: {
		async register_user( data) {
            return new Promise((resolve, reject) => {
                axios.post("auth/register", data)
                .then(response => {
                    if(response.data.res){
                        localStorage.setItem('pinia_api_auth_key', response.data.auth_token.accessToken)
                        localStorage.setItem('user_location', response.data.location)
                        this.authUser = response.data.res
                        this.authLocation = response.data.location

                        router.go({ name: 'welcome' })
                    }
                    resolve()
                })
                .catch(error=> {
                    toast.error('You have an error')
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                toast.error(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

		async login_user( data) {
            return new Promise((resolve, reject) => {
                axios.post("auth/login", data)
                .then(response => {
                    if(response.data.res){
                        localStorage.setItem('pinia_api_auth_key', response.data.auth_token.accessToken)
                        localStorage.setItem('user_location', response.data.location)
                        this.authUser = response.data.res
                        this.authLocation = response.data.location

                        router.go({ name: 'welcome' })
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                toast.error(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

        async logout_user() {
            return new Promise((resolve, reject) => {
                axios.get("auth/logout")
                .then(response => {
                    if(response.data.msg){
                        localStorage.removeItem('pinia_api_auth_key')
                        window.localStorage.clear()
                        localStorage.clear()

                        router.go({ name: 'auth' })
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                toast.error(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });  
        },
	},

	persist: true,
})