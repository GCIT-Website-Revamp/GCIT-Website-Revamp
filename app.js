const express = require("express");
const path = require("path")
const app = express()

const viewRoutes = require('./routes/viewRoutes')

app.use(express.static('public'))
app.use("/public/images", express.static(__dirname + "/public/images"));


app.use('/', viewRoutes)


app.use(express.static(path.join(__dirname, 'views')))

module.exports = app
