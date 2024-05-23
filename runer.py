import requests
import time
url = 'http://bot-vigesman.freehost.io/bot/'
while True:
    try:
        response = requests.get(url, timeout=5)
        response.raise_for_status()
        if response.text == "":
            print("ok")
        else:
            print(response.text)
    except requests.exceptions.RequestException as e: 
        print(f"Request failed: {e}")
