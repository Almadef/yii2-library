FROM alpine:3.8

ENV SPHINX_VERSION 3.1.1-612d99f

RUN apk add --no-cache mariadb-connector-c-dev \
	postgresql-dev \
	wget

RUN mkdir -pv /opt/sphinx/log /opt/sphinx/index
VOLUME /opt/sphinx/data

RUN wget http://sphinxsearch.com/files/sphinx-${SPHINX_VERSION}-linux-amd64-musl.tar.gz -O /tmp/sphinxsearch.tar.gz
RUN cd /opt/sphinx && tar -xf /tmp/sphinxsearch.tar.gz
RUN rm /tmp/sphinxsearch.tar.gz

ENV PATH "${PATH}:/opt/sphinx/sphinx-3.1.1/bin"
RUN indexer -v

RUN ln -sv /dev/stdout /opt/sphinx/log/query.log
RUN ln -sv /dev/stdout /opt/sphinx/log/searchd.log

EXPOSE 36307
VOLUME /opt/sphinx/conf

CMD searchd --nodetach --config /opt/sphinx/conf/sphinx.conf