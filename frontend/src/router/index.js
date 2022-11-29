import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import app_routes from '@/router/routes/app'
import auth_routes from '@/router/routes/auth'

const baseRoutes = []
const routes = baseRoutes.concat(auth_routes, app_routes);

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
	document.title = `${to.meta.title}`
	next();
});

router.beforeEach((to, from, next) => {
	const store = useAuthStore()
	if(to.matched.some(record => record.meta.requiresAuth)) {
		if (store.is_auth) {
			next()
			return
		}
		router.push('/auth');
	} else {
		next()
	}
})

router.beforeEach((to, from, next) => {
	const store = useAuthStore()
	if (to.matched.some((record) => record.meta.guest)) {
		if (store.is_auth) {
			router.push('/welcome')
			return;
		}
		next();
	} else {
		next();
	}
})

export default router
