FROM alpine:3.21

RUN apk add --no-cache jo jq curl bash

ADD ./temperature-producer.sh /temperature-producer.sh

ENTRYPOINT ["/temperature-producer.sh"]
