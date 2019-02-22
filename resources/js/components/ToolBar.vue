<template>
    <v-toolbar>
            <v-toolbar-title>Victor</v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="hidden-sm-and-down">
                <v-btn flat>討論區</v-btn>
                <v-btn flat>發問</v-btn>
                <v-btn flat>分類</v-btn>
                <router-link to="/login">
                    <v-btn flat>登入</v-btn>
                </router-link>
            </div>
    </v-toolbar>
</template>

<script>
export default {

}
</script>

<style>

</style>
