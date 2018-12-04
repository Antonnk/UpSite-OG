class Form {
	constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
	}

	data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
	}

	reset() {
		for (let field in this.originalData) {
            this[field] = '';
		}
		this.errors.clear();
	}

	post(url) {
		return this.submit('post', url)
	}

	submit(method, url) {
		return new Promise((resolve, reject) => {
            axios[method](url, this.data())
                .then(response => {
                    this.onSuccess(response.data)

                    resolve(response.data)
                })
                .catch(error => {
                    this.onFail(error.response.data)

                    reject(error.response.data)
                })
		})
	}


    onSuccess(data) {
        this.reset()
        return data
    }

    onFail(response) {
        this.errors.record(response.errors);
	}
}


class Errors {
	constructor() {
        this.errors = {};
	}

	record(errors) {
        this.errors = errors;
	}
	   
	has(field) {
        return this.errors.hasOwnProperty(field)
    }

    any() {
        return Object.keys(this.errors).length > 0
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0]
        }
	}

	clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
	}
}

export default Form