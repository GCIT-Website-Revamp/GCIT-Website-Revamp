const Comm = require('./../models/Community')

exports.getAllComms = async (req, res) => {
    try {
        const comm = await Comm.find()
        res.status(200).json({ data: comm, status: 'success' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

exports.createComm = async (req, res) => {
    try {
        const comm = await Comm.create(req.body);
        res.json({ data: comm, status: 'success' });
    } catch (err) {
        res.status(500).json({
            message: err.message,
        });
    }
}

exports.getComm = async (req, res) => {
    try {
        const comm = await Comm.findById(req.params.id);
        res.json({ data: comm, status: 'success' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

exports.updateComm = async (req, res) => {
    try {
        const comm = await Comm.findByIdAndUpdate(req.params.id, req.body);
        if (!comm) {
            return res.status(404).json({ status: "error", message: "Comm not found" });
        }
        res.json({ data: comm, status: "success" });
    } catch (err) {
        res.status(500).json({
            message: err.message,
        });
    }
};

exports.deleteComm = async (req, res) => {
    try {
        const comm = await Comm.findByIdAndDelete(req.params.id);
        res.json({ data: comm, status: 'success' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}
