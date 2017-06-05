
import VueRouter from 'vue-router'

const routes = [
  // { path: '/', component: require('./components/Example') },
  // { path: '/', component: require('./components/Chat') },
  { path: '/', component: require('./components/PrivateMessages/privateMessageLanding') },
  { path: '/inbox', component: require('./components/PrivateMessages/privateMessage') },
  { path: '/sent', component: require('./components/PrivateMessages/sentPrivateMessages') },
  { path: '/sendPM', component: require('./components/PrivateMessages/composePM') },
  { path: '/pms/:id', component: require('./components/PrivateMessages/PMByID'), name: '/pms' }

]


export default new VueRouter({
  routes // short for routes: routes
})
