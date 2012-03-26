UJS= /Users/xjia/node_modules/uglify-js/bin/uglifyjs
SRC= article/edit.js article/index.js avatar/edit.js experience/edit.js home/index.js honor/edit.js invite/show.js paper/edit.js profile/new.js profile/show.js register/show.js video/show.js jquery.countdown.js
MIN= article/edit.min.js article/index.min.js avatar/edit.min.js experience/edit.min.js home/index.min.js honor/edit.min.js invite/show.min.js paper/edit.min.js profile/new.min.js profile/show.min.js register/show.min.js video/show.min.js jquery.countdown.min.js

all: $(MIN)
	#

article/edit.min.js: $(SRC)
	$(UJS) article/edit.js > article/edit.min.js

article/index.min.js: $(SRC)
	$(UJS) article/index.js > article/index.min.js

avatar/edit.min.js: $(SRC)
	$(UJS) avatar/edit.js > avatar/edit.min.js

experience/edit.min.js: $(SRC)
	$(UJS) experience/edit.js > experience/edit.min.js

home/index.min.js: $(SRC)
	$(UJS) home/index.js > home/index.min.js

honor/edit.min.js: $(SRC)
	$(UJS) honor/edit.js > honor/edit.min.js

invite/show.min.js: $(SRC)
	$(UJS) invite/show.js > invite/show.min.js

paper/edit.min.js: $(SRC)
	$(UJS) paper/edit.js > paper/edit.min.js

profile/new.min.js: $(SRC)
	$(UJS) profile/new.js > profile/new.min.js

profile/show.min.js: $(SRC)
	$(UJS) profile/show.js > profile/show.min.js

register/show.min.js: $(SRC)
	$(UJS) register/show.js > register/show.min.js

video/show.min.js: $(SRC)
	$(UJS) video/show.js > video/show.min.js

jquery.countdown.min.js: $(SRC)
	$(UJS) jquery.countdown.js > jquery.countdown.min.js

