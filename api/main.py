import pymysql
from app import app
from config import mysql
from flask import jsonify
from flask import flash, request


@app.route('/users', methods=['POST'])
def add_user():
    try:
        _json = request.json
        _firstName = _json['firstName']
        _surName = _json['surName']
        _title = _json['title']
        _country = _json['country']
        _city = _json['city']
        _email = _json['email']
        _password = _json['password']

        if _firstName and _surName and _title and _country and _city and _email and _password and request.method == 'POST':
            sqlQuery = "INSERT INTO users(first_name, sir_name, title, country, city, email, password) VALUES(%s, %s, %s, %s, %s, %s, %s)"
            bindData = (_firstName, _surName, _title, _country, _city, _email, _password)
            conn = mysql.connect()
            cursor = conn.cursor()
            cursor.execute(sqlQuery, bindData)
            conn.commit()
            response = jsonify('User added successfully!')
            response.status_code = 200
            return response
        else:
            return not_found()
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/users', methods=['GET'])
def list_users():
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM users")
        usersRows = cursor.fetchall()
        respone = jsonify(usersRows)
        respone.status_code = 200
        return respone
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/users/<int:id>', methods=['GET'])
def get_user(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        cursor.execute("SELECT * FROM users WHERE id =%s limit 1", id)
        empRow = cursor.fetchone()
        response = jsonify(empRow)
        response.status_code = 200
        return response
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/users', methods=['PUT'])
def update_user():
    try:
        _json = request.json
        _firstName = _json['firstName']
        _surName = _json['surName']
        _title = _json['title']
        _country = _json['country']
        _city = _json['city']
        _id = _json['id']

        # validate the received values
        if _firstName and _surName and _title and _country and _city and _id and request.method == 'PUT':
            sqlQuery = "UPDATE users SET first_name=%s, sir_name=%s, title=%s, country=%s, city=%s WHERE id=%s"
            bindData = (_firstName, _surName, _title, _country, _city, _id)
            conn = mysql.connect()
            cursor = conn.cursor()
            cursor.execute(sqlQuery, bindData)
            conn.commit()
            response = jsonify('User updated successfully!')
            response.status_code = 200
            return response
        else:
            return not_found()
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.route('/users/<int:id>', methods=['DELETE'])
def delete_user(id):
    try:
        conn = mysql.connect()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM users WHERE id =%s", id)
        conn.commit()
        response = jsonify('User deleted successfully!')
        response.status_code = 200
        return response
    except Exception as e:
        print(e)
    finally:
        cursor.close()
        conn.close()


@app.errorhandler(404)
def not_found(error=None):
    message = {
        'status': 404,
        'message': 'Record not found: ' + request.url,
    }
    response = jsonify(message)
    response.status_code = 404
    return response


if __name__ == "__main__":
    app.run()
