<template>
  <div class="container">
    <form @submit.prevent="addUser" class="form">
      <div class="form-group">
        <input
            v-model="newUser.name"
            placeholder="Name"
            class="form-control"
            required
        />
        <span v-if="nameError" class="error">{{ nameError }}</span>
      </div>
      <div class="form-group">
        <input
            v-model="newUser.email"
            type="email"
            placeholder="Email"
            class="form-control"
            required
        />
        <span v-if="emailError" class="error">{{ emailError }}</span>
      </div>
      <div class="form-group">
        <input
            v-model="newUser.password"
            type="password"
            placeholder="Password"
            class="form-control"
            required
        />
        <span v-if="passwordError" class="error">{{ passwordError }}</span>
      </div>
      <div class="form-group">
        <input
            v-model="newUser.password_confirmation"
            type="password"
            placeholder="Confirm Password"
            class="form-control"
            required
        />
        <span v-if="confirmPasswordError" class="error">{{ confirmPasswordError }}</span>
      </div>
      <button type="submit" class="btn btn-primary">Add User</button>
    </form>
    <table class="table">
      <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Skills</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.description }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      newUser: { name: '', email: '', password: '', password_confirmation: '' },
      nameError: null,
      emailError: null,
      passwordError: null,
      confirmPasswordError: null,
    };
  },
  methods: {
    fetchUsers() {
      axios.get('http://localhost:8000/api/users').then(response => {
        this.users = response.data;
      });
    },
    validateName() {
      const namePattern = /^(?:\d{1,12}|[A-Za-z]{1,12})$/;
      if (!namePattern.test(this.newUser.name)) {
        this.nameError = 'Имя должно содержать либо только цифры (не более 12 символов), либо только буквы в обоих регистрах (не более 12 символов).';
        return false;
      }
      this.nameError = null;
      return true;    },
    validateEmail() {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(this.newUser.email)) {
        this.emailError = 'Please enter a valid email address.';
        return false;
      }
      this.emailError = null;
      return true;
      },
    validatePassword() {
      const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
      if (!passwordPattern.test(this.newUser.password)) {
        this.passwordError = 'Пароль должен иметь длину не менее 8 символов и содержать хотя бы одну строчную букву, одну заглавную букву и одну цифру.';
        return false;
      }
      this.passwordError = null;
      return true;    },
    validateConfirmPassword() {
      if (this.newUser.password !== this.newUser.password_confirmation) {
        this.confirmPasswordError = 'Passwords do not match.';
        return false;
      }
      this.confirmPasswordError = null;
      return true;
    },
    addUser() {
      if (this.validateName() && this.validateEmail() && this.validatePassword() && this.validateConfirmPassword()) {
        axios.post('http://localhost:8000/api/users', this.newUser).then(() => {
          this.fetchUsers();
          this.newUser = { name: '', email: '', password: '', password_confirmation: '' };
        });
      }
    },
  },
  mounted() {
    this.fetchUsers();
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.form {
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 10px;
}

.form-control {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
}

.error {
  color: red;
  font-size: 0.875em;
}

.btn {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}

.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.table th, .table td {
  border: 1px solid #ddd;
  padding: 8px;
}

.table th {
  background-color: #f2f2f2;
}

.table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tbody tr:hover {
  background-color: #f1f1f1;
}
</style>

