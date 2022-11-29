import { useAuthStore } from '@/stores/auth'

const auth = (to, from, next) => {
  	const store = useAuthStore()
    if(localStorage.getItem('pinia_api_auth_key') != null){
		if(store.is_auth != null ){
			return next()
		}
		else{
			return next({ name: 'auth' })
		}
    }
    else{
		return next({ name: 'auth' })
    }
};

const app_routes = [
	{
  		path: '/', beforeEnter: auth, meta: { requiresAuth: true, title: 'Pinia Authentications'},
		component: () => import('@/views/main.vue'),
		children: [
			// Welcome Page
			{
				path: '/welcome', name: 'welcome', meta: { requiresAuth: true, title: `Welcome` },
				component: () => import('@/views/app/welcomePage.vue')
			},

			// Blogs Page
			{
				path: '/blogs', name: 'blogs', meta: { requiresAuth: true, title: `Blogs` },
				component: () => import('@/views/app/blogs.vue')
			},

			// Add Blog Page
			{
				path: '/add-blog', name: 'add-blog', meta: { requiresAuth: true, title: `Add Blog` },
				component: () => import('@/views/app/add-blog.vue')
			},

			// Edit Blog Page
			{
				path: '/edit-blog/:id', name: 'edit-blog', meta: { requiresAuth: true, title: `Edit Blog` },
				component: () => import('@/views/app/edit-blog.vue')
			},
		]
	}
];

export default app_routes;