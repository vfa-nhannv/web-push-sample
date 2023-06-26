# create publicKey & privateKey
openssl ecparam -name prime256v1 -genkey -noout -out private_key.pem
openssl ec -in private_key.pem -pubout -outform DER | tail -c 65 | base64 | tr -d '\n'

# web-push-sample
Docker run
docker compose up -d