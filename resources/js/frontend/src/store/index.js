import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store(
	{
		namespaced: true,
		state:
		{
			employeeData: null,
			employeeDataBase:
			{
				employee:
					[
						{
							id: 1,
							firstName: 'John',
							lastName: 'Doe',
							position: 'Accounting',
							sickLeaveCredits: 3,
							hourlyRate: 1000
						},
						{
							id: 2,
							firstName: 'Mark',
							lastName: 'Doe',
							position: 'Accounting',
							sickLeaveCredits: 3,
							hourlyRate: 1200
						}
					]
			}
		},
		getters:
		{
			//...
		},
		actions:
		{
			getEmployeeData(context)
			{
				context.commit('SET_EMPLOYEE_DATA', context.state.employeeDataBase);
			},
			searchEmployeeData(context, requestData)
			{
				//...
			},
			deleteEmployeeData(context, requestData)
			{
				context.commit('DELETE_EMPLOYEE_DATA', requestData)
			},
			resetEmployeeData(context)
			{
				context.commit('RESET_EMPLOYEE_DATA', null);
			}
		},
		mutations:
		{
			SET_EMPLOYEE_DATA(state, payload)
			{
				state.employeeData = payload;
			},
			DELETE_EMPLOYEE_DATA(state, payload)
			{
				state.employeeData.employee = state.employeeData.employee.filter(element => element.id !== payload)
			},
			RESET_EMPLOYEE_DATA(state, payload)
			{
				state.employeeData = payload;
			}
		},
		modules:
		{
			//...
		}
	});
