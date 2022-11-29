import { defineStore } from 'pinia'
import axios from 'axios'

export const useBlogsStore = defineStore('blogs', {
	state: () => ({
		blogs: [],
        blog: '',
        loading: ''
	}),

	getters: {
		all_blogs: (state )=> state.blogs,
		single_blog: (state )=> state.blog,
		button_loading: state => state.loading,
	},

	actions: {
        async search_blog( data) {
            return new Promise((resolve, reject) => {
                this.loading = 'search_blog'
                axios.post("app/blogs/search", data)
                .then(response => {
                    if(response.data.res){
                        this.blog = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

        async get_blogs() {
            return new Promise((resolve, reject) => {
                this.loading = 'get_blogs'
                axios.get("app/blogs")
                .then(response => {
                    if(response.data.res){
                        this.blogs = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

		async create_blog( data) {
            return new Promise((resolve, reject) => {
                this.loading = 'create_blog'
                axios.post("app/blogs/create", data)
                .then(response => {
                    if(response.data.res){
                        this.blogs = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

		async get_blog( id ) {
            return new Promise((resolve, reject) => {
                this.loading = 'get_blog'
                axios.get(`app/blogs/${id}`)
                .then(response => {
                    if(response.data.res){
                        this.blog = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

        async update_blog(data, id) {
            return new Promise((resolve, reject) => {
                this.loading = 'update_blog'
                axios.post(`app/blogs/update/${id}`, data)
                .then(response => {
                    if(response.data.res){
                        this.blogs = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });  
        },

        async update_blog_image(data, id) {
            this.loading = 'update_blog_image'
            return new Promise((resolve, reject) => {
                axios.post(`app/blogs/update_image/${id}`, data)
                .then(response => {	
                    if(response.data.res){
                        this.blog = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
                            }
                        }
                    }
                    reject()
                });
            });
        },

        async delete_blog(id) {
            return new Promise((resolve, reject) => {
                this.loading = 'delete_blog'
                axios.get(`app/blogs/delete/${id}`)
                .then(response => {
                    if(response.data.res){
                        this.blogs = response.data.res
                        this.loading = ''
                    }
                    resolve()
                })
                .catch(error=> {
                    if (error.response) {
                        if(error.response.data){
                            if(error.response.data.msg){
                                console.log(error.response.data.msg)
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