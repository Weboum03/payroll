import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
// import auth from '../store/auth'
import lang from '../store/lang'
import { auth } from "./auth.module";

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth,
        lang
    }
})

export default store
