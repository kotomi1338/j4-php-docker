# 使い方
1. docker-entrypoint-initdb.d/ 以下の2ファイルのユーザ名を自分のに変える
2. docker-entrypoint-initdb.d/02_pg_dump.sql のcompany_xxを自分の出席番号に変える
3. docker-compose up -d
4. volumes/web/html 以下に作った.phpファイルを置く
5. http://localhost:8080
6. docker神
