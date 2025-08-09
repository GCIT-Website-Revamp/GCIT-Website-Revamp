const express = require('express')
const commController = require('./../controllers/communityController')
const router = express.Router()

router
    .route('/')
    .get(commController.getAllComms)
    .post(commController.createComm)

    router
    .route('/:id')
    .get(commController.getComm)
    .patch(commController.updateComm)
    .delete(commController.deleteComm)

module.exports = router