<template>
    <v-toolbar color="indigo" dark>
            <v-toolbar-title>
              <router-link class="white--text" to="/">
                Victor
              </router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <app-notification v-if="loggedIn"></app-notification>

            <div class="hidden-sm-and-down">

                <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                v-if="item.show">
                    <v-btn flat>{{item.title}}</v-btn>
                </router-link>

            </div>
    </v-toolbar>
</template>

<script>
import AppNotification from './AppNotification';
export default {
  components:{AppNotification},
  data(){
    return {
      loggedIn: User.loggedIn(),
      items: [
        {title : '討論區' , to:'/forum',show:true},
        {title : '發問' , to:'/ask',show: User.loggedIn()},
        {title : '分類' , to:'/category',show: User.admin()},
        {title : '登入' , to:'/login',show: !User.loggedIn()},
        {title : '登出' , to:'/logout',show: User.loggedIn()},
      ]
    }
  },
  created(){
    EventBus.$on('logout',() => {
      User.logout()
    })
  }
}
</script>

<style>

</style>
