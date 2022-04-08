<template>
  <b-container id="app" class="p-0" fluid>
    <b-row no-gutters style="height: 100vh">
      <!-- APP NAVIGATION -->
      <b-col cols="2">
        <b-nav vertical class="d-flex align-items-center bg-primary h-100 p-4">
          <b-img
            src="https://psite-ncr.org/wp-content/uploads/2020/04/inal-black-300x127-1.png"
            width="150"
            class="mb-3"
          />
          <b-nav-item :to="{ name: 'employee-management' }" class="font-weight-bold">Employee Management</b-nav-item>
        </b-nav>
      </b-col>
      <!-- END APP NAVIGATION -->
      <!-- APP ROUTER VIEW -->
      <b-col cols="10" style="height: 100vh">
        <router-view />
      </b-col>
      <!-- END APP ROUTER VIEW -->
    </b-row>
  </b-container>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.router-link-exact-active {
  color: rgb(28, 33, 45);
  background-color: rgb(255, 216, 49);
  border-radius: 5px;
}
</style>
