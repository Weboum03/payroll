import { ref, reactive, inject } from 'vue'
import { useRouter } from "vue-router";
import { AbilityBuilder, createMongoAbility } from '@casl/ability';
import { ABILITY_TOKEN } from '@casl/vue';
import store from '../store'
import apiClient from './api-client';

let user = reactive({
    name: '',
    email: '',
})

export default function useAuth() {
    const processing = ref(false)
    const validationErrors = ref({})
    const router = useRouter()
    const swal = inject('$swal')
    const ability = inject(ABILITY_TOKEN)

    const loginForm = reactive({
        email: '',
        password: '',
        remember: false
    })

    const forgotForm = reactive({
        email: '',
    })

    const resetForm = reactive({
        email: '',
        token: '',
        password: '',
        password_confirmation: ''
    })

    const registerForm = reactive({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    })

    const submitLogin = async () => {
        if (processing.value) return

        processing.value = true
        validationErrors.value = {}
        store.dispatch("auth/login", loginForm).then(
            async () => {
                await loginUser()
                router.push({ name: 'admin.index' })
            },
            (error) => {
            //   loading = false;
             let message =
                (error.response &&
                  error.response.data &&
                  error.response.data.error) ||
                error.error ||
                error.toString();
                swal({
                    icon: 'error',
                    title: message
                }) 
            }
          );

        // await axios.post('/api/admin/auth/login', loginForm)
        //     .then(async response => {
        //         await store.dispatch('auth/getUser')
        //         await loginUser()
        //         if (response.data.access_token) {
        //             localStorage.setItem('user', JSON.stringify(response.data));
        //           }
        //         swal({
        //             icon: 'success',
        //             title: 'Login successfully 1',
        //             showConfirmButton: false,
        //             timer: 1500
        //         })
        //         await router.push({ name: 'admin.index' })
        //     })
        //     .catch(error => {
        //         if (error.response?.data) {
        //             validationErrors.value = error.response.data.errors
        //         }
        //     })
        //     .finally(() => processing.value = false)
    }

    const submitRegister = async () => {
        if (processing.value) return

        processing.value = true
        validationErrors.value = {}

        await axios.post('/api/admin/auth/register', registerForm)
            .then(async response => {
                // await store.dispatch('auth/getUser')
                // await loginUser()
                swal({
                    icon: 'success',
                    title: 'Registration successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                await router.push({ name: 'auth.login' })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => processing.value = false)
    }

    const submitForgotPassword = async () => {
        if (processing.value) return

        processing.value = true
        validationErrors.value = {}

        await axios.post('/api/admin/forget-password', forgotForm)
            .then(async response => {
                swal({
                    icon: 'success',
                    title: 'We have emailed your password reset link! Please check your mail inbox.',
                    showConfirmButton: false,
                    timer: 1500
                })
                // await router.push({ name: 'admin.index' })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => processing.value = false)
    }

    const submitResetPassword = async () => {
        if (processing.value) return

        processing.value = true
        validationErrors.value = {}

        await axios.post('/admin/reset-password', resetForm)
            .then(async response => {
                swal({
                    icon: 'success',
                    title: 'Password successfully changed.',
                    showConfirmButton: false,
                    timer: 1500
                })
                await router.push({ name: 'auth.login' })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => processing.value = false)
    }

    const loginUser = () => {
        user = store.state.auth.user
        // Cookies.set('loggedIn', true)
       getAbilities()
    }

    const getUser = async () => {
        if (store.getters['auth/authenticated']) {
            await store.dispatch('auth/getUser')
            await loginUser()
        }
    }

    const logout = async () => {
        if (processing.value) return

        processing.value = true

        user.name = ''
        user.email = ''
        store.dispatch('auth/logout')
        localStorage.removeItem('user');
        router.push({ name: 'auth.login' })

        axios.post('/api/auth/logout')
            .then(response => {
                user.name = ''
                user.email = ''
                store.dispatch('auth/logout')
                localStorage.removeItem('user');
                router.push({ name: 'auth.login' })
            })
            .catch(error => {
                // swal({
                //     icon: 'error',
                //     title: error.response.status,
                //     text: error.response.statusText
                // })
            })
            .finally(() => {
                processing.value = false
                // Cookies.remove('loggedIn')
            })
    }

    const getAbilities = async() => {
        console.log('Rahul', store.state.auth.user.access_token);
        const loginUser = store.state.auth.user;
        await axios.get('/api/admin/abilities',{ headers: {"Authorization" : `Bearer ${loginUser.access_token}`} })
            .then(response => {
                const permissions = response.data
                const { can, rules } = new AbilityBuilder(createMongoAbility)

                can(permissions)

                ability.update(rules)
            })
    }

    return {
        loginForm,
        registerForm,
        forgotForm,
        resetForm,
        validationErrors,
        processing,
        submitLogin,
        submitRegister,
        submitForgotPassword,
        submitResetPassword,
        user,
        getUser,
        logout,
        getAbilities
    }
}
