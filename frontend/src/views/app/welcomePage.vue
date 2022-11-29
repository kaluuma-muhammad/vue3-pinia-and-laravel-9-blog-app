<template>
  <div class="home">
	<h1>We welcome you, {{ user.name }}</h1>
    <p>This is our welcome page</p>

	<button @click="sign_out_user">Sign Out</button>


  </div>
</template>

<script setup>
	import { useAuthStore } from '@/stores/auth'

	const AuthStore = useAuthStore()
	const user  = AuthStore.auth_user

	const sign_out_user = () => {
		AuthStore.logout_user()
	}
</script>
