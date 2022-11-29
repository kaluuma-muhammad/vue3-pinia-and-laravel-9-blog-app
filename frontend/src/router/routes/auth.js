let auth_routes = [
    {
		path: '/auth', name: 'auth', meta: { guest: true, title: 'Pinia Authentications' },
		component: () => import('@/views/app/authPage.vue') 
	},
]

export default auth_routes;