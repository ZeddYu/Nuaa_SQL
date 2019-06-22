Vue.component('model', {
    props: ['id', 'name'],
    template: '<div><b-modal v-model="modalShow">Hello From Modal!</b-modal></div>'
})

const config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
}

new Vue({
    el: '#book_table',
    data: {
        books: [],
        showModal: false,
        book_id: null,
        book_name: null,
        book_author: null,
        book_num: null,
        book_ISBN: null,
        book_unitPrice: null,
    },
    created: function () {
        var vm = this;
        axios.post("http://zedd.cc/?s=Book.GetAll")
            .then(response => {
                return response.data.data['info'];
            })
            .then(function (data) {
                vm.books = data
            })
    },
    methods: {
        editBook: function (id, name, author, ISBN, num, price) {
            this.showModal = true;
            this.book_id = id;
            this.book_name = name;
            this.book_author = author;
            this.book_num = num;
            this.book_ISBN = ISBN;
            this.book_unitPrice = price;
        },
        updateBook: function (book_id, book_name, book_author, book_ISBN, book_num, book_unitPrice) {
            const params = new URLSearchParams();
            params.append('book_id', book_id);
            params.append('book_name', book_name);
            params.append('book_author', book_author);
            params.append('book_ISBN', book_ISBN);
            params.append('book_num', book_num);
            params.append('book_unitPrice', book_unitPrice);
            axios.post("http://zedd.cc/?s=Book.updateBook", params, config)
                .then(response => {
                    if (response.data.data['status'] == true) {
                        alert("更新成功");
                    }
                    else
                        alert("更新失败");
                })
                .then(function () {
                    location.reload();
                })
        },
        delBook: function (book_id) {
            const params = new URLSearchParams();
            params.append('book_id', book_id);
            axios.post("http://zedd.cc/?s=Book.delBook", params, config)
                .then(response => {
                    if (response.data.data['status'] == true) {
                        alert("删除成功");
                    }
                    else
                        alert("删除失败");
                })
                .then(function () {
                    location.reload();
                })
        }
    }
})

new Vue({
    el: '#book_rank',
    data: {
        books: []
    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=Book.getBookOrder")
            .then(response => {
                return response.data.data['info'];
            })
            .then(function (data) {
                vm.books = data
            })
    }
})

new Vue({
    el: '#data_section',
    data: {
        user_sum: 0,
        sum: 0,
        lent_sum: 0,
        all_cost: 0,

    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=Book.getBookSum")
            .then(response => {
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.sum = data
            })
        axios.get("http://zedd.cc/?s=Book.getBookLentSum")
            .then(response => {
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.lent_sum = data
            })
        axios.get("http://zedd.cc/?s=Book.getAllBookPrice")
            .then(response => {
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.all_cost = data
            })

        axios.get("http://zedd.cc/?s=User.getUserSum")
            .then(response => {
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.user_sum = data
            })

    }
})



new Vue({
    el: '#log_list',
    data: {
        logs: 0
    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=Log.getAllHisLog")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['info'];
            })
            .then(function (data) {
                vm.logs = data;
            })
    }
})

new Vue({
    el: '#user_list',
    data: {
        users: 0
    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=user.getAllUser")
            .then(response => {
                return response.data.data['info'];
            })
            .then(function (data) {
                vm.users = data;
            })
    },
    methods: {
        delUser: function (user_id) {
            const params = new URLSearchParams();
            params.append('user_id', user_id);
            axios.post("http://zedd.cc/?s=user.deleteUser", params, config)
                .then(response => {
                    if (response.data.data['status'] == true) {
                        alert("删除成功");
                    }
                    else
                        alert("删除失败");
                })
                .then(function () {
                    location.reload();
                })
        }
    }
})

new Vue({
    el: '#book_tool',
    data: {
        showModal: false,
        book_name: null,
        book_author: null,
        book_num: null,
        book_ISBN: null,
        book_unitPrice: null,
    },
    methods: {
        addItem: function (book_name, book_author, book_ISBN, book_num, book_unitPrice) {
            const params = new URLSearchParams();
            params.append('book_name', book_name);
            params.append('book_author', book_author);
            params.append('book_ISBN', book_ISBN);
            params.append('book_num', book_num);
            params.append('book_unitPrice', book_unitPrice);
            axios.post("http://zedd.cc/?s=Book.addBook", params, config)
                .then(response => {
                    if (response.data.data['status'] == true) {
                        alert("增加成功");
                    }
                    else
                        alert("增加失败");
                })
                .then(function () {
                    location.reload();
                })

        }
    }

})