import { createStore } from "vuex";
import auth from "./modules/auth";

// * modules
export default createStore({
    modules: {
        auth
    }
})
