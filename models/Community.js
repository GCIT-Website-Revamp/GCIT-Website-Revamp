const mongoose = require ('mongoose')

const communitySchema = new mongoose.Schema ({
    student:{
        type:String,
        required:[true,'Please enter the no. of stds']
    },
    acad:{
        type:String,
        required:[true,'Please enter the no. of academic staff'],
    },
    nAcad:{
        type:String,
        required:[true,'Please enter the no. of nonacad staff'],
    }
})

const Community = mongoose.model('Community', communitySchema)
module.exports = Community