const path = require("path")

exports.getLoginForm=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'Login.html'))
}

exports.getSignupForm=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'Signup.html'))
}

exports.getIndexPage=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'index.html'))
}

exports.getContactPage=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'contact.html'))
}

exports.getCartPage=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'addtocart.html'))
}

exports.getAdminLoginForm=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'LoginForm.html'))
}

exports.getAdminDashboard=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'dashboard.html'))
}

exports.getAdminConfirmedOrders=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'ConfirmedOrders.html'))
}

exports.getAdminAddProduct=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'AddProduct.html'))
}

exports.getAdminNewOrders=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'NewOrders.html'))
}

exports.getAdminProducts=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'Products.html'))
}

exports.getAdminUpdateProduct=(req, res) => {
    res.sendFile(path.join(__dirname, '../', 'views', 'admin', 'UpdateProduct.html'))
}