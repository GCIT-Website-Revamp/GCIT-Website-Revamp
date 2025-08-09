const express = require('express')
const router = express.Router()
const viewController = require('./../controllers/viewController')

router.get('/login', viewController.getLoginForm)
router.get('/signup', viewController.getSignupForm)
router.get('/', viewController.getIndexPage)
router.get('/contact', viewController.getContactPage)
router.get('/cart', viewController.getCartPage)

router.get('/admin/login', viewController.getAdminLoginForm)
router.get('/admin/dashboard', viewController.getAdminDashboard)
router.get('/admin/orders', viewController.getAdminConfirmedOrders)
router.get('/admin/neworders', viewController.getAdminNewOrders)
router.get('/admin/products', viewController.getAdminProducts)
router.get('/admin/add', viewController.getAdminAddProduct)
router.get('/admin/update', viewController.getAdminUpdateProduct)

module.exports = router