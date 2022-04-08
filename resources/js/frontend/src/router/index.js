import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
	{
		path: '/',
		redirect: '/employee-management'
	},
	{
		path: '/employee-management',
		name: 'employee-management',
		component: () => import(/* webpackChunkName: "employee-management" */ '../views/EmployeeManagementView.vue')
	},
];

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
});

export default router;
