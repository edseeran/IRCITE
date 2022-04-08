<template>
  <b-row id="employee-management" no-gutters class="h-100">
    <b-col class="d-flex flex-column bg-light">
      <div class="d-flex flex-row bg-white p-4 border">
        <!-- SEARCH EMPLOYEE BY ID -->
        <b-button variant="secondary" class="font-weight-bold" v-b-modal="'modal-search-employee'">
          Search Employee
        </b-button>
        <!-- END SEARCH EMPLOYEE BY ID -->
        <!-- LIST EMPLOYEES BUTTON -->
        <b-button variant="secondary" class="font-weight-bold ml-3" @click="$store.dispatch('getEmployeeData')">
          List Employees
        </b-button>
        <!-- END LIST EMPLOYEES BUTTON -->
      </div>
      <!-- EMPLOYEE MANAGEMENT PAGE BODY -->
      <div class="d-flex flex-column h-100 p-3">
        <!-- LIST EMPLOYEES INFO -->
        <div v-if="employeeData">
          <div v-for="(employee, index) in employeeData.employee" :key="`employee-${index}`">
            <b-row no-gutters class="d-flex flex-row align-items-center bg-white p-3 mb-3 border rounded">
              <b-col md="2">
                <b-avatar variant="info" class="mr-3" />
                <span class="mr-1">{{ employee.firstName }}</span>
                <span>{{ employee.lastName }}</span>
              </b-col>
              <b-col md="2">
                <div>
                  <span class="font-weight-bold">ID: </span>
                  {{ employee.id }}
                </div>
              </b-col>
              <b-col md="2">
                <div>
                  <span class="font-weight-bold">Position: </span>
                  {{ employee.position }}
                </div>
              </b-col>
              <b-col md="2">
                <div>
                  <span class="font-weight-bold">Sick Leave Credits: </span>
                  {{ employee.sickLeaveCredits }}
                </div>
              </b-col>
              <b-col md="2">
                <div>
                  <span class="font-weight-bold">Hourly Rate: </span>
                  {{ employee.hourlyRate }}
                </div>
              </b-col>
              <b-col md="2" class="d-flex flex-row justify-content-center">
                <b-button variant="dark" size="sm"> Edit </b-button>
              </b-col>
            </b-row>
          </div>
        </div>
        <!-- LIST EMPLOYEES INFO -->
        <span v-else class="d-flex flex-row justify-content-center align-items-center h-100"> No data shown </span>
      </div>
      <!-- END EMPLOYEE MANAGEMENT PAGE BODY -->
    </b-col>
    <!-- MODAL: SEARCH EMPLOYEE -->
    <b-modal
      id="modal-search-employee"
      title="Get or Delete Employee"
      title-class="primary"
      header-bg-variant="secondary"
      footer-text-variant="primary"
      no-close-on-backdrop
      no-close-on-esc
      centered
    >
      <b-form>
        <b-form-group id="ig-employee-id" label="Employee ID:" label-for="employee-id" class="mb-0">
          <b-form-input id="employee-id" v-model="searchedEmployee" type="text" />
        </b-form-group>
      </b-form>
      <template #modal-footer>
        <b-button variant="danger">Delete</b-button>
        <b-button variant="secondary">Search</b-button>
      </template>
    </b-modal>
    <!-- END MODAL: SEARCH EMPLOYEE -->
  </b-row>
</template>

<script>
import store from "@/store/index.js";

export default {
  name: "employee-management",
  data: () => ({
    searchedEmployee: "",
  }),
  computed: {
    employeeData: () => store.state.employeeData,
  },
  method: {
    searchEmployeeData(id) {
      //...
    },
  },
  beforeCreate() {
    //...
  },
  destroyed() {
    store.dispatch("resetEmployeeData");
  },
};
</script>

<style lang="scss" scoped>
//...
</style>
