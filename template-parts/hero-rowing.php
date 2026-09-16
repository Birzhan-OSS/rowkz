<?php
/**
 * Анимированный фон главной: одиночка на рассвете (SVG + SMIL).
 * При prefers-reduced-motion анимация ставится на паузу.
 *
 * @package rowkz
 */
?>
<svg class="rk-rowing" viewBox="0 0 1600 720" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
	<defs>
		<linearGradient id="rkSky" x1="0" y1="0" x2="0" y2="1">
			<stop offset="0" stop-color="#0b1a28"/>
			<stop offset=".55" stop-color="#16395a"/>
			<stop offset="1" stop-color="#2c6f93"/>
		</linearGradient>
		<linearGradient id="rkWater" x1="0" y1="0" x2="0" y2="1">
			<stop offset="0" stop-color="#1f5a7c"/>
			<stop offset="1" stop-color="#0c2233"/>
		</linearGradient>
		<radialGradient id="rkSun" cx="0.5" cy="0.5" r="0.5">
			<stop offset="0" stop-color="#ffe7b8" stop-opacity=".95"/>
			<stop offset=".35" stop-color="#f7c989" stop-opacity=".45"/>
			<stop offset="1" stop-color="#f7c989" stop-opacity="0"/>
		</radialGradient>
		<linearGradient id="rkGlare" x1="0" y1="0" x2="0" y2="1">
			<stop offset="0" stop-color="#ffe2ad" stop-opacity=".55"/>
			<stop offset="1" stop-color="#ffe2ad" stop-opacity="0"/>
		</linearGradient>
	</defs>

	<!-- небо и солнце -->
	<rect width="1600" height="720" fill="url(#rkSky)"/>
	<circle cx="1380" cy="430" r="300" fill="url(#rkSun)"/>
	<circle cx="1380" cy="442" r="44" fill="#ffe9c4" opacity=".92"/>

	<!-- дальний берег -->
	<path d="M0 452 C 160 430 300 438 440 446 S 760 424 920 440 1240 428 1400 442 1560 436 1600 440 L1600 470 L0 470 Z" fill="#0d2536" opacity=".85"/>

	<!-- вода -->
	<rect y="468" width="1600" height="252" fill="url(#rkWater)"/>
	<g stroke="#ffe2ad" stroke-linecap="round">
		<line x1="1343" y1="482" x2="1413" y2="482" stroke-width="2.0" opacity="0.55"><animate attributeName="opacity" values="0.55;0.17;0.55" dur="1.60s" repeatCount="indefinite"/></line>
		<line x1="1327" y1="494" x2="1417" y2="494" stroke-width="2.4" opacity="0.45"><animate attributeName="opacity" values="0.45;0.14;0.45" dur="1.97s" repeatCount="indefinite"/></line>
		<line x1="1350" y1="508" x2="1410" y2="508" stroke-width="2.8" opacity="0.4"><animate attributeName="opacity" values="0.4;0.12;0.4" dur="2.34s" repeatCount="indefinite"/></line>
		<line x1="1333" y1="524" x2="1443" y2="524" stroke-width="3.2" opacity="0.32"><animate attributeName="opacity" values="0.32;0.10;0.32" dur="2.71s" repeatCount="indefinite"/></line>
		<line x1="1329" y1="542" x2="1409" y2="542" stroke-width="3.6" opacity="0.26"><animate attributeName="opacity" values="0.26;0.08;0.26" dur="3.08s" repeatCount="indefinite"/></line>
		<line x1="1305" y1="566" x2="1435" y2="566" stroke-width="4.0" opacity="0.2"><animate attributeName="opacity" values="0.2;0.06;0.2" dur="3.45s" repeatCount="indefinite"/></line>
		<line x1="1335" y1="596" x2="1435" y2="596" stroke-width="4.4" opacity="0.15"><animate attributeName="opacity" values="0.15;0.04;0.15" dur="3.82s" repeatCount="indefinite"/></line>
		<line x1="1291" y1="630" x2="1451" y2="630" stroke-width="4.8" opacity="0.1"><animate attributeName="opacity" values="0.1;0.03;0.1" dur="4.19s" repeatCount="indefinite"/></line>
	</g>

	<!-- волны: три слоя с разной скоростью -->
	<g opacity=".35">
		<path d="M0 500 q50 -8 100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0" fill="none" stroke="#9fd0e6" stroke-width="1.5">
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-200 0" dur="9s" repeatCount="indefinite"/>
		</path>
	</g>
	<g opacity=".25">
		<path d="M0 560 q70 -10 140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0" fill="none" stroke="#9fd0e6" stroke-width="2">
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-280 0" dur="7s" repeatCount="indefinite"/>
		</path>
	</g>
	<g opacity=".18">
		<path d="M0 640 q100 -14 200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0" fill="none" stroke="#9fd0e6" stroke-width="3">
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-400 0" dur="5s" repeatCount="indefinite"/>
		</path>
	</g>

	<!-- буйки дорожки: создают ощущение движения лодки вперёд -->
	<g fill="#f2b705" opacity=".75">
		<g>
			<?php for ( $x = 0; $x <= 1760; $x += 80 ) : ?>
				<ellipse cx="<?php echo (int) $x; ?>" cy="596" rx="5" ry="3"/>
			<?php endfor; ?>
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-80 0" dur="1.2s" repeatCount="indefinite"/>
		</g>
	</g>

	<!-- одиночка: нос справа, гребец сидит лицом к корме (влево). Позу считает скрипт ниже. -->
	<g id="rk-boat" transform="translate(1150 540) scale(1.25)">
		<!-- кильватерный след -->
		<g stroke="#cfe8f3" stroke-linecap="round" fill="none">
			<path id="rk-wake1" d="M-250 5 H-380" stroke-width="2" opacity=".4"/>
			<path id="rk-wake2" d="M-280 11 H-450" stroke-width="1.5" opacity=".25"/>
		</g>
		<ellipse cx="20" cy="13" rx="270" ry="5" fill="#06131d" opacity=".35"/>

		<!-- дальнее весло (приглушено) -->
		<g opacity=".45">
			<polyline id="rk-oar-far" fill="none" stroke="#0c2233" stroke-width="3" stroke-linecap="round" points="0,0 0,0"/>
			<ellipse id="rk-blade-far" rx="18" ry="6" fill="#0c2233"/>
		</g>

		<!-- корпус -->
		<path d="M-250 0 C -170 -5 190 -9 300 -2 C 190 5 -170 8 -250 0 Z" fill="#f4f1ea"/>
		<path d="M-250 0 C -170 3 190 3 300 -2" fill="none" stroke="#1d6f93" stroke-width="2.5"/>
		<rect x="-58" y="-9" width="16" height="6" rx="2" fill="#9fb0bd"/><!-- подножка -->
		<path d="M-2 -4 L2 -22" stroke="#c9d3da" stroke-width="2.5" stroke-linecap="round"/><!-- уключина -->

		<!-- гребец -->
		<g fill="none" stroke="#0c2233" stroke-linecap="round" stroke-linejoin="round">
			<rect id="rk-seat" x="-8" y="-12" width="18" height="4" rx="2" fill="#0c2233" stroke="none"/>
			<polyline id="rk-leg" stroke-width="7.5" points="0,0 0,0 0,0"/>
			<path id="rk-torso" stroke-width="12" d="M0 0 L0 0"/>
			<polyline id="rk-arm" stroke-width="5.5" points="0,0 0,0 0,0"/>
		</g>
		<circle id="rk-head" r="9.5" fill="#0c2233"/>

		<!-- ближнее весло -->
		<polyline id="rk-oar" fill="none" stroke="#081723" stroke-width="4" stroke-linecap="round" points="0,0 0,0"/>
		<ellipse id="rk-blade" rx="20" ry="7" fill="#f2b705"/>

		<!-- круги на воде в момент захвата -->
		<circle id="rk-splash" r="0" fill="none" stroke="#dff1f8" stroke-width="1.8" opacity="0"/>
	</g>
</svg>
<script>
(function () {
	var svg = document.querySelector('.rk-rowing');
	if (!svg) return;
	var $ = function (id) { return svg.getElementById ? svg.getElementById(id) : document.getElementById(id); };
	var el = {
		boat: $('rk-boat'), seat: $('rk-seat'), leg: $('rk-leg'), torso: $('rk-torso'), arm: $('rk-arm'), head: $('rk-head'),
		oar: $('rk-oar'), blade: $('rk-blade'), oarFar: $('rk-oar-far'), bladeFar: $('rk-blade-far'),
		splash: $('rk-splash'), wake1: $('rk-wake1'), wake2: $('rk-wake2')
	};
	if (!el.boat) return;

	// ---- параметры (координаты лодки: нос справа, вода на y = 0) ----
	var PERIOD = 3.2;            // секунд на гребок (≈19 гребков/мин — спокойная тренировка)
	var DRIVE = 0.36;            // доля проводки
	var FOOT = [-66, -10];       // упор ног
	var THIGH = 36, SHIN = 36, TORSO = 46, UPPER = 23, FORE = 23;
	var PIN = [0, -22];          // уключина
	var SEAT_CATCH = -34, SEAT_FINISH = 4;
	var LEAN_CATCH = 28, LEAN_FINISH = -24;  // наклон корпуса в градусах (плюс — к корме)

	var clamp = function (v, a, b) { return Math.max(a, Math.min(b, v)); };
	var ease = function (t) { t = clamp(t, 0, 1); return t * t * (3 - 2 * t); };          // smoothstep
	var easeIO = function (t) { t = clamp(t, 0, 1); return t < .5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2; };
	var lerp = function (a, b, t) { return a + (b - a) * t; };
	var rad = Math.PI / 180;

	// Двухзвенная инверсная кинематика: длины звеньев постоянны.
	// prefer = 'up' — сустав выше линии (колено), 'down' — ниже (локоть).
	function ik(a, b, l1, l2, prefer) {
		var dx = b[0] - a[0], dy = b[1] - a[1];
		var d = clamp(Math.hypot(dx, dy), Math.abs(l1 - l2) + .01, l1 + l2 - .01);
		var base = Math.atan2(dy, dx);
		var off = Math.acos(clamp((l1 * l1 + d * d - l2 * l2) / (2 * l1 * d), -1, 1));
		var p1 = [a[0] + l1 * Math.cos(base + off), a[1] + l1 * Math.sin(base + off)];
		var p2 = [a[0] + l1 * Math.cos(base - off), a[1] + l1 * Math.sin(base - off)];
		var up = p1[1] < p2[1] ? p1 : p2, down = up === p1 ? p2 : p1;
		return prefer === 'up' ? up : down;
	}
	var pt = function (p) { return p[0].toFixed(1) + ',' + p[1].toFixed(1); };

	// Фазы: проводка — ноги → корпус → руки; возврат — руки → корпус → ноги.
	function phases(p) {
		if (p < DRIVE) {
			var u = p / DRIVE;
			return { legs: easeIO(u / .62), body: ease((u - .22) / .58), arms: ease((u - .55) / .45), inWater: 1, drive: u };
		}
		var r = (p - DRIVE) / (1 - DRIVE);
		return {
			legs: 1 - easeIO((r - .28) / .72),
			body: 1 - ease((r - .06) / .34),
			arms: 1 - ease(r / .2),
			inWater: 1 - ease(r / .06) + ease((r - .93) / .07),  // подъём лопасти после финиша и опускание перед захватом
			drive: -1, rec: r
		};
	}

	function pose(t) {
		var p = (t / PERIOD) % 1;
		var f = phases(p);

		// сиденье и таз
		var seatX = lerp(SEAT_CATCH, SEAT_FINISH, f.legs);
		var hip = [seatX, -16];
		var knee = ik(FOOT, hip, SHIN, THIGH, 'up');

		// корпус
		var lean = lerp(LEAN_CATCH, LEAN_FINISH, f.body) * rad;
		var shoulder = [hip[0] - Math.sin(lean) * TORSO, hip[1] - Math.cos(lean) * TORSO];
		var headP = [shoulder[0] - Math.sin(lean) * 12 - 2, shoulder[1] - Math.cos(lean) * 12 - 1];

		// рукоятка: на захвате руки прямые и тянутся к корме, на финише — у нижних рёбер.
		// По высоте рукоятка у уключины: чуть выше на проводке (лопасть в воде), ниже на возврате.
		var handY = PIN[1] - 4 * f.inWater + 3 * (1 - f.inWater);
		var reachDx = Math.sqrt(Math.max(0, Math.pow(UPPER + FORE - 1, 2) - Math.pow(handY - shoulder[1], 2)));
		var reachX = shoulder[0] - reachDx;
		var pullX = shoulder[0] + 9;
		var hand = [lerp(reachX, pullX, f.arms), handY];
		var elbow = ik(shoulder, hand, UPPER, FORE, 'down');

		// весло проходит через уключину; лопасть — с противоположной стороны от рукоятки
		var lever = PIN[0] - hand[0];
		var bladeX = PIN[0] + (lever > 0 ? lever * 1.3 : lever * 2.6);
		var bladeY = lerp(-9, 5, f.inWater);
		var squared = f.drive >= 0 ? 1 : clamp(1 - ease((f.rec - .02) / .1) + ease((f.rec - .82) / .12), 0, 1); // разворот лопасти

		el.seat.setAttribute('x', (seatX - 9).toFixed(1));
		el.leg.setAttribute('points', pt(FOOT) + ' ' + pt(knee) + ' ' + pt(hip));
		el.torso.setAttribute('d', 'M' + pt(hip) + ' Q' + pt([lerp(hip[0], shoulder[0], .5) + 3, lerp(hip[1], shoulder[1], .5)]) + ' ' + pt(shoulder));
		el.arm.setAttribute('points', pt(shoulder) + ' ' + pt(elbow) + ' ' + pt(hand));
		el.head.setAttribute('cx', headP[0].toFixed(1));
		el.head.setAttribute('cy', headP[1].toFixed(1));

		el.oar.setAttribute('points', pt(hand) + ' ' + pt(PIN) + ' ' + pt([bladeX, bladeY]));
		el.blade.setAttribute('cx', (bladeX + 8).toFixed(1));
		el.blade.setAttribute('cy', bladeY.toFixed(1));
		el.blade.setAttribute('ry', lerp(2.2, 7, squared).toFixed(2));

		el.oarFar.setAttribute('points', pt([hand[0] + 4, hand[1] - 3]) + ' ' + pt([PIN[0] + 4, PIN[1] - 3]) + ' ' + pt([bladeX + 6, bladeY - 4]));
		el.bladeFar.setAttribute('cx', (bladeX + 14).toFixed(1));
		el.bladeFar.setAttribute('cy', (bladeY - 4).toFixed(1));
		el.bladeFar.setAttribute('ry', lerp(2, 6, squared).toFixed(2));

		// круги на воде сразу после захвата
		var s = f.drive >= 0 && f.drive < .35 ? f.drive / .35 : -1;
		if (s >= 0) {
			el.splash.setAttribute('cx', (bladeX + 8).toFixed(1));
			el.splash.setAttribute('cy', '6');
			el.splash.setAttribute('r', (6 + s * 22).toFixed(1));
			el.splash.setAttribute('opacity', ((1 - s) * .7).toFixed(2));
		} else {
			el.splash.setAttribute('opacity', '0');
		}

		// лодка ускоряется на проводке и слегка «проседает» при захвате
		var surge = f.drive >= 0 ? Math.sin(f.drive * Math.PI) * 5 : -Math.sin(f.rec * Math.PI) * 2;
		var bob = f.drive >= 0 ? -Math.sin(f.drive * Math.PI) * 1.2 : Math.sin(f.rec * Math.PI) * .8;
		var pitch = f.drive >= 0 ? -Math.sin(f.drive * Math.PI) * .35 : Math.sin(f.rec * Math.PI) * .25;
		el.boat.setAttribute('transform', 'translate(' + (1150 + surge).toFixed(1) + ' ' + (540 + bob).toFixed(1) + ') rotate(' + pitch.toFixed(2) + ') scale(1.25)');
		var w = f.drive >= 0 ? .25 + .3 * Math.sin(f.drive * Math.PI) : .25;
		el.wake1.setAttribute('opacity', (w + .15).toFixed(2));
		el.wake2.setAttribute('opacity', w.toFixed(2));
	}

	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)');
	var running = false, visible = true, start = null, raf = 0, elapsed = 0;

	function frame(now) {
		if (start === null) start = now - elapsed * 1000;
		elapsed = (now - start) / 1000;
		pose(elapsed);
		raf = requestAnimationFrame(frame);
	}
	function play() {
		if (running || (reduce && reduce.matches) || !visible) return;
		running = true; start = null;
		if (svg.unpauseAnimations) svg.unpauseAnimations();
		raf = requestAnimationFrame(frame);
	}
	function stop() {
		running = false; cancelAnimationFrame(raf);
		if (svg.pauseAnimations) svg.pauseAnimations();
	}

	pose(PERIOD * DRIVE * .55); // статичный кадр: середина проводки
	if (reduce && reduce.addEventListener) reduce.addEventListener('change', function () { reduce.matches ? stop() : play(); });
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (entries) {
			visible = entries[0].isIntersecting;
			visible ? play() : stop();
		}).observe(svg);
	}
	if (reduce && reduce.matches) { stop(); } else { play(); }
})();
</script>
