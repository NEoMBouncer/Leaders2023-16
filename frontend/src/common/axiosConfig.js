//Import Axios Library and Auth0
import axios from 'axios';

//Create instance of axios
const instance = axios.create({
    baseURL: import.meta.env.VITE_APP_API_URL
});

// Create a request interceptor for my instance and get accessToken on the fly
instance.interceptors.request.use(async (config) => {
    // const { getAccessTokenSilently } = useAuth0();
    // const accessToken = await getAccessTokenSilently();
    // config.headers['Authorization'] = accessToken;
    // config.headers['Origin'] = import.meta.env.VITE_APP_URL
    // console.log(config.headers['Origin'])
    // config.headers['Access-Control-Allow-Origin'] = '*'
    // config.headers['Access-Control-Allow-Headers'] = 'Origin, Content-Type, Authorization'
    // config.headers['Access-Control-Allow-Credentials'] = true
    // config.headers = {
    //         'Origin': import.meta.env.VITE_APP_URL,
    //         'Access-Control-Allow-Origin': '*',
    //         'Access-Control-Allow-Headers': 'Origin, Content-Type, Authorization',
    //         'Access-Control-Allow-Credentials': true
    // }
    return config;
}, (error) => {
    return Promise.reject(error)
});

instance.interceptors.response.use(async (config) => {
    config.headers = {
            'Origin': '*',
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': 'Origin, Content-Type, Authorization',
            'Access-Control-Allow-Credentials': true
    }
    return config;
}, (error) => {
    return Promise.reject(error)
});

export default instance;