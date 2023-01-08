<template>
	<div>
		<h2>Pinia Authentications</h2>
		<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form @submit.prevent="signup_data">
					<h1>Create Account</h1>
					<div class="social-container">
						<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
						<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
						<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
					</div>
					<span>or use your email for registration</span>
					<input v-model="sighUpForm.name" type="text" placeholder="Name" />
					<span class="text-danger" v-if="sighUpFormError.name">{{ sighUpFormError.name }}</span>

					<input v-model="sighUpForm.email" type="email" placeholder="Email" />
					<span class="text-danger" v-if="sighUpFormError.email">{{ sighUpFormError.email }}</span>

					<input v-model="sighUpForm.contact" type="text" placeholder="Contact" />
					<span class="text-danger" v-if="sighUpFormError.contact">{{ sighUpFormError.contact }}</span>

					<input v-model="sighUpForm.password" type="password" placeholder="Password" />
					<span class="text-danger" v-if="sighUpFormError.password">{{ sighUpFormError.password }}</span>

					<button type="submit">Sign Up</button>
				</form>
			</div>
			<div class="form-container sign-in-container">
				<form @submit.prevent="sign_in_data">
					<h1>Sign in</h1>
					<div class="social-container">
						<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
						<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
						<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
					</div>
					<span>or use your account</span>
					<input v-model="sighInForm.contact" type="contact" placeholder="Contact" />
					<span class="text-danger" v-if="sighInFormError.contact">{{ sighInFormError.contact }}</span>

					<input v-model="sighInForm.password" type="password" placeholder="Password" />
					<span class="text-danger" v-if="sighInFormError.password">{{ sighInFormError.password }}</span>

					<a href="#">Forgot your password?</a>
					<button>Sign In</button>
				</form>
			</div>
			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Welcome Back!</h1>
						<p>To keep connected with us please login with your personal info</p>
						<button @click.prevent="signIn" class="ghost" id="signIn">Sign In</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Hello, Friend!</h1>
						<p>Enter your personal details and start journey with us</p>
						<button @click.prevent="signUp" class="ghost" id="signUp">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import '@/assets/auth.css'
	import $ from 'jquery'
	import { reactive  } from 'vue';
	import { useAuthStore } from '../../stores/auth'
	
	const AuthStore = useAuthStore()

	const signUp = () => {
		$('#container').addClass('right-panel-active')
    }

	const signIn = () => {
		$('#container').removeClass('right-panel-active')
    }

	const sighUpForm = reactive({
		name: '',
		email: '',
		contact: '',
		password: '',
	})

	const sighUpFormError = reactive({
		name: '',
		email: '',
		contact: '',
		password: '',
	})

	const sighInForm = reactive({
		contact:  '',
		password: '',
	})

	const sighInFormError = reactive({
		contact:  '',
		password: '',
	})

	const signup_data = () => {
		if(sighUpForm.name == "") {
			sighUpFormError.name = 'Please Enter Name';
            setTimeout(() => sighUpFormError.name = '', 3000)
		}
		if(sighUpForm.email == "") {
			sighUpFormError.email = 'Please Enter Email';
            setTimeout(() => sighUpFormError.email = '', 3000)
		}
		if(sighUpForm.contact == "") {
			sighUpFormError.contact = 'Please Enter Contact';
            setTimeout(() => sighUpFormError.contact = '', 3000)
		}
		if(sighUpForm.password == "") {
			sighUpFormError.password = 'Please Enter Password';
            setTimeout(() => sighUpFormError.password = '', 3000)
		}

		if (sighUpForm.name != '' && sighUpForm.email != '' && sighUpForm.contact != '' && sighUpForm.password != '') {
			let data = new FormData()
			data.append('name', sighUpForm.name)
			data.append('email', sighUpForm.email)
			data.append('contact', sighUpForm.contact)
			data.append('password', sighUpForm.password)

			AuthStore.register_user(data)
		}
	}

	const sign_in_data = () => {
		if(sighInForm.contact == "") {
			sighInFormError.contact = 'Please Enter Contact';
            setTimeout(() => sighInFormError.contact = '', 3000)
		}
		if(sighInForm.password == "") {
			sighInFormError.password = 'Please Enter Password';
            setTimeout(() => sighInFormError.password = '', 3000)
		}

		if (sighInForm.contact != '' && sighInForm.password != '') {
			let data = new FormData()
			data.append('contact', sighInForm.contact)
			data.append('password', sighInForm.password)

			AuthStore.login_user(data)
		}
	}
</script>
