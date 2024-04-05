connection=new Mongo()
db=connection.getDB("LogNATURE");
db.createCollection("log");